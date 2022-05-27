<?php

namespace app\controllers;

use app\components\QuestieWidget;
use app\models\QuestionForm;
use app\models\Test;
use app\models\TestConstructor;
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
}
