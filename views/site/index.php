<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Главная';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Сервис по созданию онлайн-тестов</h1>

        <p class="lead">Создайте свой собственный тест за 5 минут!</p>

    </div>

    <div class="body-content">

        <?= Html::a('Создать новый тест', ['test/create'], ['class' => 'btn btn-primary btn-block btn-lg']) ?>
        <div class="viewOr">или</div>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'hash_link')->textInput(['class' => 'form-control text-center'])->label(false) ?>

        <div class="form-group text-center">
            <?= Html::submitButton('Открыть существующий тест', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>