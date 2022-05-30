<?php

use yii\helpers\Html;

echo $form->field($item, "[$key]answer")->radioList(
    $item->choices,
    ['class' => 'compactRadioGroup', 'item' => function ($index, $label, $name, $checked, $value) use ($item, $studentAnswers, $key) {


        if(!is_string($studentAnswers[$key]->given))
        {
            foreach ($studentAnswers[$key]->given as $answerItem){
                if ($answerItem == $index) {
                    if ( in_array($answerItem, $item->answer)) {
                        $style = 'style="background-color: green"';
                    } else {
                        $style = 'style="background-color: red"';
                    }
                }
            }

        }

        
        

        return '<div class="label-q" ' . $style . '">' .
            Html::tag('p', $label, ['class' => 'question-label ml-2 mb-0']) . '</div>';
    }]
)->label(false);

?>