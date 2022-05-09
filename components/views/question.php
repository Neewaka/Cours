<?php

use yii\bootstrap4\Html;

// var_dump($item);die;
?>



<div class="question-box container m-3">
    <div class="row">
        <div class="col-11 question-form" style="box-shadow: 0 0 10px 0px #bdbdbd; display:inline-block">
            <?= $form->field($item, "[$key]choices")->hiddenInput(['class' => 'choices-form'])->label(false) ?>
            <?= $form->field($item, "[$key]question")->label('Вопрос ' . ($key + 1)) ?>

            <div class="container">
                <?=
                $form->field($item, "[$key]answer")->radioList(
                    $item->choices,
                    ['class' => 'compactRadioGroup', 'item' => function ($index, $label, $name, $checked, $value) use ($item) {
                        if ($label == $item->answer) {
                            $checked = true;
                        }
                        return '<div class="label-q" style="display: flex">' .
                            Html::radio($name, $checked, ['value'  => $value, 'style' => 'margin-top: 5px']) .
                            Html::tag('p', $label, ['class' => 'question-label ml-2 mb-0', 'contenteditable' => true]) .
                            Html::tag('div', '-', ['class' => 'label-delete btn btn-danger']) . '</div>';
                    }]
                )->label(false) ?>

                <p class="btn form-add-choice"><u>добавить еще один вариант...</u></p>
            </div>
        </div>
        <div class="btn btn-danger form-delete col-1" style="box-shadow: 0 0 10px 0px #bdbdbd; vertical-align: middle;">X</div>
    </div>

</div>