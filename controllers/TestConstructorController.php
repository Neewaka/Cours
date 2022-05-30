<?php

namespace app\controllers;

use app\components\QuestieWidget;
use app\models\QuestionForm;
use app\models\Test;
use app\models\TestConstructor;
use app\models\TestResult;
use Codeception\Lib\Interfaces\Web;
use yii\bootstrap4\ActiveForm;
use yii\helpers\VarDumper;
use Yii;

class TestConstructorController extends AppController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAddQuestion()
    {
        $post = Yii::$app->request->post();

        $item = QuestionForm::createExampleTest($post['type']);

        $session = Yii::$app->session;
        $questions = $session->get('questions');
        
        $questions[] = $item;

        $session->set('questions', $questions);

        return $this->renderPartial('/test/questions', [
            'items' => $questions,
            'testType' => $item->type,
        ]);
    }

    protected function findModel($testHash)
    {

        if (($model = Test::find()->where(['hash_link' => $testHash])->one()) !== null) {
            return $model;
        }
    }

    public function actionCreate()
    {
        $model = Test::find()->where(['id' => (int)$_POST['id']])->one();
        $model->getTestResults();
        $tests = TestResult::find()->where(['test_id' => (int)$_POST['id']])->all();

        $filepath = 'json/' . time() . '.json';
        $fo = fopen($filepath, 'w');
        fwrite($fo, '[');
        foreach((array)$tests as $item)
        {
            fwrite($fo, json_encode($item->attributes));
            fwrite($fo, ',');
        }
        
        fwrite($fo, ']');
        fclose($fo);

        return Yii::getAlias('@web') .'/' . $filepath;
    }
}
