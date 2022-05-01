<?php

namespace app\components;

use yii\base\Widget;
use yii\bootstrap4\ActiveForm;

class QuestieWidget extends Widget
{

    public $dada = 'da';

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

    public function question($key, $item, $form)
    {
        // var_dump($this->class);die;

        return $this->render(
            'question',
            [
                'key' => $key,
                'item' => $item,
                'form' => $form,
            ]
        );
    }

    public function viewQuestions($items)
    {
        $html = '';
        $form = ActiveForm::begin(['id' => 'questions-form']);
        foreach ($items as $key => $item) {
            $html .= $this->question($key, $item, $form);
        }
        ActiveForm::end();

        return $html .= $this->bottomForm();
    }

    public function bottomForm()
    {
        return $this->render(
            'bottom'
        );
    }
}
