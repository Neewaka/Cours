<?php 

use yii\helpers\Html;


echo $form->field($item, "[$key]answer")->checkboxList(
    $item->choices,
    ['class' => 'compactRadioGroup', 'item' => function ($index, $label, $name, $checked, $value) use ($item) {
        return '<div class="label-q" style="display: flex">' .
            Html::checkbox($name, $checked, ['value'  => $value, 'style' => 'margin-top: 5px']) .
            Html::tag('p', $label, ['class' => 'question-label ml-2 mb-0']) . '</div>';
    }]
)->label(false) 

?>