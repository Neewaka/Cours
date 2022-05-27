<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\VarDumper;
?>

<? if (!$form) {
    $form = ActiveForm::begin(['id' => 'questions-form']);
}

?>

<div class="question-box container m-3">
    <div class="row">
        <div class="col-11 question-form" style="box-shadow: 0 0 10px 0px #bdbdbd; display:inline-block">
            <?= $form->field($item, "[$key]choices")->hiddenInput(['class' => 'choices-form'])->label(false) ?>
            <?= $form->field($item, "[$key]type")->hiddenInput()->label(false) ?>
            <?= $form->field($item, "[$key]question")->label('Вопрос ' . ($key + 1), ['class' => 'control-label']) ?>

            <div class="container">
                <?=
                $form->field($item, "[$key]answer")->label(false) ?>
            </div>
        </div>
        <div class="btn btn-danger form-delete col-1" style="box-shadow: 0 0 10px 0px #bdbdbd; vertical-align: middle;">X</div>
    </div>

</div>

<? if (!$form) {
    ActiveForm::end();
} ?>