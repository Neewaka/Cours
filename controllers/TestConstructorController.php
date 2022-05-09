<?php

namespace app\controllers;

use app\components\QuestieWidget;
use app\models\QuestionForm;
use app\models\Test;
use Yii;

class TestConstructorController extends AppController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAddQuestion()
    {

        $item = QuestionForm::createExampleTest();

        $session = Yii::$app->session;
        $questions = $session->get('questions');
        $questions[] = $item;
        $session->set('questions', $questions);

        return $this->renderPartial('/test/_questions', [
            'items' => $questions,
        ]);
    }

    protected function findModel($testHash)
    {

        if (($model = Test::find()->where(['hash_link' => $testHash])->one()) !== null) {
            return $model;
        }
    }
}
