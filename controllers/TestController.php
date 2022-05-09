<?php

namespace app\controllers;

use app\models\Test;
use app\models\TestBaseForm;
use app\models\TestForm;
use app\models\TestSearch;
use app\models\TestResultSearch;
use app\models\TestResult;
use app\models\QuestionForm;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;

class TestController extends AppController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['questions', 'settings', 'publish', 'results'],
                'rules' => [
                    [
                        'actions' => ['questions', 'settings', 'publish', 'results'],
                        'allow' => true,
                        'matchCallback' => function () {
                            $cookies = Yii::$app->request->cookies;
                            $test = $cookies->getValue('test');
                            $url_array = explode('/', Yii::$app->request->url);
                            $hash_link = array_search('test', $url_array);
                            $currentTestHash = $url_array[++$hash_link];
                            if ($test == $currentTestHash) {
                                return true;
                            } elseif (!Yii::$app->user->isGuest) {
                                if (Test::getTestByHash($currentTestHash)->created_by == Yii::$app->user->id) {
                                    return true;
                                }
                            }
                            return false;
                        }
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new TestSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $testBase = new TestBaseForm();

        if ($testBase->load(\Yii::$app->request->post()) && $testBase->validate()) {

            \Yii::$app->session['testBase'] = $testBase;
            if ($test = $testBase->createTest()) {

                $cookies = Yii::$app->response->cookies;
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'test',
                    'value' => $test->hash_link,
                ]));

                return $this->redirect(['settings', 'hash_link' => $test->hash_link]);
            }
        }

        return $this->render('create', [
            'model' => $testBase,
        ]);
    }

    public function actionSettings($hash_link)
    {
        $this->layout = 'test';
        $model = $this->findModel($hash_link);
        $this->testInfo = $model;

        if ($model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Данные обновлены');
            return $this->refresh();
        }

        return $this->render('settings', [
            'model' => $model,
        ]);
    }

    public function actionDelete($hash_link)
    {
        $test = $this->findModel($hash_link);
        $test_name = $test->title;
        $test->delete();

        Yii::$app->session->setFlash('success', "Тест $test_name удален");

        return $this->goHome();
    }

    public function actionQuestions($hash_link)
    {

        $this->layout = 'test';
        $model = $this->findModel($hash_link);
        $this->testInfo = $model;

        $session = Yii::$app->session;

        if (Yii::$app->request->isGet) {
            $session->remove('questions');
        }

        if ($session->has('questions')) {
            $items = $session->get('questions');
        } else {
            if (empty($model->test_body)) {
                $items = [QuestionForm::createExampleTest()];
            } else {
                $items = QuestionForm::unpackTest($model->test_body);
            }
            $session->set('questions', $items);
        }



        if (Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();
            if ($post['QuestionForm']) {

                $model->test_body = json_encode($post['QuestionForm']);
                // var_dump($items);die;
                if (Model::loadMultiple($items, Yii::$app->request->post() )) {
                    VarDumper::dump($items,10,true);
                    die;
                    $model->save();
                    Yii::$app->session->setFlash('success', 'Данные обновлены');
                } else {
                    Yii::$app->session->setFlash('error', 'Данные не обновлены');
                }

                return $this->refresh();
            }
        }


        return $this->render('questions', [
            'items' => $items,
        ]);
    }

    public function actionPublish($hash_link)
    {
        $this->layout = 'test';
        $model = $this->findModel($hash_link);
        $this->testInfo = $model;

        if ($this->request->post()) {
            $model->is_published = 1;
            if ($model->save()) {
                $this->refresh();
            }
        }

        return $this->render('publish', [
            'model' => $model,
        ]);
    }

    public function actionResults($hash_link)
    {
        $this->layout = 'test';
        $model = $this->findModel($hash_link);
        $this->testInfo = $model;

        $searchModel = new TestResultSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $procents = $this->calculateProcents($dataProvider);

        return $this->render('results', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'procents' => $procents,
        ]);
    }

    public function actionView($hash_link)
    {
        $test = $this->findModel($hash_link);
        $this->testInfo = $test;
        $model = new TestForm;
        $model->test = $test;

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validateAdminPassword()) {

                $cookies = Yii::$app->response->cookies;
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'test',
                    'value' => $hash_link,
                ]));
                return $this->redirect(['settings', 'hash_link' => $test->hash_link]);
            } else {
                return $this->redirect([
                    'student', 'hash_link' => $test->hash_link,
                    'name' => Yii::$app->request->post()['TestForm']['name'],
                    'email' => Yii::$app->request->post()['TestForm']['email']
                ]);
            }
        }

        return $this->render('view', [
            'model' => $model,
            'test' => $test,
        ]);
    }

    public function actionStudent($hash_link, $name, $email)
    {
        $test = $this->findModel($hash_link);
        $this->testInfo = $test;

        $items = QuestionForm::unpackTest($test->test_body);

        if ($form = $this->request->post()['QuestionForm']) {

            $result = [];
            foreach ($form as $key => $item) {
                $result[] = ['given' => $key . $item['answer'], 'correct' => $items[$key]->answer == $item['answer'] ? 1 : 0];
            }

            $testResult = new TestResult;
            $testResult->test_id = $test->id;
            $testResult->name = $name;
            $testResult->email = $email ? $email : null;
            $testResult->result = json_encode($result);

            if ($testResult->save()) {
                return $this->redirect([
                    'student-result', 'hash_link' => $hash_link, 'testResult' => $testResult->id
                ]);
            }
        }

        return $this->render('student', [
            'items' => $items,
            'test' => $test,
            'studentName' => $name,
        ]);
    }

    public function actionStudentResult($hash_link, $testResult)
    {
        $test = $this->findModel($hash_link);
        $result = $this->findResult($testResult);
        $items = QuestionForm::unpackTest($test->test_body);

        $ajax = Yii::$app->request->isAjax ? true : false;

        return $this->render('student_result', [
            'test' => $test,
            'items' => $items,
            'studentAnswers' => (array) json_decode($result->result),
            'studentName' => $result->name,
            'ajax' => $ajax,
        ]);
    }

    protected function findModel($testHash)
    {

        if (($model = Test::find()->where(['hash_link' => $testHash])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findResult($id)
    {

        if (($model = TestResult::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function calculateProcents($dataProvider)
    {
        $output = array();
        $array = array(1.0, 0.79, 0.49, 0.19);
        $models = $dataProvider->models;
        foreach ($models as $key => $item) {
            $answers = array_count_values(array_column((array)json_decode($dataProvider->models[$key]->result), 'correct'));
            $resultCoef = $answers[1] / ($answers[0] + $answers[1]);
            $search = $resultCoef;
            var_dump($search);
            $procentGroup = $this->reduce($search, $array);
            $output[$procentGroup]++;
        }
        // var_dump($output);die;
        return $output;
    }

    protected function reduce($search, array $pattern)
    {
        $cnt = count($pattern);
        for ($i = 0; $i < $cnt; $i++) {
            // var_dump('i == ' . $i);
            if (!isset($pattern[$i + 1]) || $search <= $pattern[$i] && $search > $pattern[$i + 1]) {
                // var_dump('Вышел');
                return $i;
            }
        }
    }
}
