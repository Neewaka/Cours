<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<h1>Создание теста</h1>

<p>Пожалуйста заполните следующие поля для создания теста: </p>

<div class="jumbotron">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'password') ?>

        <div class="form-group">
            <?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>