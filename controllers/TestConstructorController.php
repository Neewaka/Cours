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

        // return TestConstructor::renderQuestion();

        $item = QuestionForm::createExampleTest();

        $session = Yii::$app->session;
        $questions = $session->get('questions');

        $activeform = ActiveForm::begin(['id' => 'questions-form']);
        $form = QuestieWidget::begin();
        $quest = $form->question(4, $item, $activeform);
        QuestieWidget::end();
        ActiveForm::end();

        // VarDumper::dump($questions,10,true);die;
        $questions[] = $item;
        $session->set('questions', $questions);

        return $this->renderPartial('/test\questions', [
            'items' => $quest,
        ]);
    }

    protected function findModel($testHash)
    {

        if (($model = Test::find()->where(['hash_link' => $testHash])->one()) !== null) {
            return $model;
        }
    }
}
