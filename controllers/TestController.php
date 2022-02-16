<?php

namespace app\controllers;

use app\models\Test;
use app\models\TestBaseForm;
use app\models\TestForm;
use app\models\TestSearch;
use app\models\TestResultSearch;
use app\models\QuestionForm;
use yii\filters\AccessControl;
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
                            $hash_link = explode('/', Yii::$app->request->url)[2];
                            if($test == $hash_link)
                            {
                                return true;
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

        return $this->render('settings', [
            'model' => $model,
        ]);
    }

    public function actionQuestions($hash_link)
    {

        $this->layout = 'test';
        $model = $this->findModel($hash_link);
        $this->testInfo = $model;

        if (empty($model->test_body)) {
            $items = [$this->createExampleTest()];
        } else {
            $items = $this->unpackTest($model->test_body);
        }

        if (Yii::$app->request->isPost) {
            $post = \Yii::$app->request->post();
            if ($post['QuestionForm']) {
                $model->test_body = json_encode($post['QuestionForm']);
                $model->save();
                $this->refresh();
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

        return $this->render('results', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($hash_link)
    {
        $test = $this->findModel($hash_link);
        $this->testInfo = $test;
        $model = new TestForm;
        $model->test = $test;

        //admin entrance
        if ($model->load(\Yii::$app->request->post())) {
            if ($model->validateAdminPassword()) {

                $cookies = Yii::$app->response->cookies;
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'test',
                    'value' => $hash_link,
                ]));

                return $this->redirect(['settings', 'hash_link' => $test->hash_link]);
            } else if ($model->validateAdminPassword()) {
                return $this->redirect(['student', 'hash_link' => $test->hash_link]);
            }
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionStudent($hash_link)
    {
        $model = $this->findModel($hash_link);
        $this->testInfo = $model;

        $items = $this->unpackTest($model->test_body);

        return $this->render('student', [
            'items' => $items,
        ]);
    }

    protected function findModel($testHash)
    {

        if (($model = Test::find()->where(['hash_link' => $testHash])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function createExampleTest()
    {
        $example = new QuestionForm();
        $example->question = 'Question';
        $example->choices = ['choice 1', 'choice 2', 'choice 3', 'choice 4'];
        return $example;
    }

    protected function unpackTest($testBody)
    {
        $testArray = json_decode($testBody);
        $result = [];

        foreach ($testArray as $item) {
            $test = new QuestionForm();
            $test->answer = $item->answer;
            $test->choices = explode(',', $item->choices);
            $test->question = $item->question;
            $result[] = $test;
        }

        return $result;
    }
}










// {"0":{"question":"Question55555","answer":"Chhhhhh1"},"choices":"Chhhhhh1,choice 2,choice 3,choice 4","2":{"answer":"wwwwwww"}}