<?php

namespace app\components;

use yii\base\Widget;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

class QuestieWidget extends Widget
{

    public $dada = 'da';
    public $questionsForm;

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();

        return $content;
    }

    public function question($key, $item, $form = null)
    {
        $view = '';
        switch ($item->type) {
            case '1':
                $view = 'question';
                break;
            case '2':
                $view = 'question_multiple';
                break;
            case '3':
                $view = 'question_trueFalse';
                break;
            case '4':
                $view = 'question_fill';
                break;
        };

        if($view == '')
        {
            var_dump($item);die;
        }


        return $this->render(
            $view,
            [
                'key' => $key,
                'item' => $item,
                'form' => $form,
            ]
        );
    }

    public function viewQuestions($items)
    {
        $this->questionsForm = ActiveForm::begin(['id' => 'questions-form']);

        echo Html::beginTag('div', ['class' => 'test-time-form']);

        echo Html::input('checkbox', 'QuestionForm[test-time-need]',null,['checked' => $items['time-need']]);
        echo Html::label('Ограничивать время на прохождение теста?', null, ['class' => 'test-time-label']);

        echo Html::input('time', 'QuestionForm[test-time]', $items['time'], ['step' => '2']);
        echo Html::endTag('div');

        echo Html::beginTag('div', ['id' => 'questions-container']);
        foreach ($items['items'] as $key => $item) {
            echo $this->question($key, $item, $this->questionsForm);
        }
        echo Html::endTag('div');
        echo $this->bottomForm();
        ActiveForm::end();
    }

    public function bottomForm()
    {
        return $this->render(
            'bottom'
        );
    }
}
