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
        // var_dump($this->class);die;
        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();

        return $content;
    }

    public function question($key, $item)
    {
        // var_dump($this->class);die;

        return $this->render(
            'question',
            [
                'key' => $key,
                'item' => $item,
                'form' => $this->questionsForm,
            ]
        );
    }

    public function viewQuestions($items)
    {
        $this->questionsForm = ActiveForm::begin(['id' => 'questions-form']);
        echo Html::beginTag('div', ['class' => 'questions']);
        foreach ($items as $key => $item) {
            echo $this->question($key, $item);
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
