<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Test */

?>

<ul class="list-group list-group-horizontal">
    <li class="list-group-item"><button id='role-student' class="btn btn-secondary btn-lg active">Пользователь</button></li>
    <li class="list-group-item"><button id='role-admin' class="btn btn-secondary btn-lg ">Администрирование</button></li>
</ul>

<div class="jumbotron view-jumbotron">

    <h1 class="display-4">Тест <b><?= $this->context->testInfo->title ?></b></h1>

    <? if($test->subject):?>
        <p><?= $test->subject ?></p>
    <? else: ?>
        <p class="lead">У данного теста еще нет темы</p>
    <? endif;?>
    
    <hr class="my-4">
    
    <?php $form = ActiveForm::begin(['id' => 'test-form']); ?>

    <? if(!$test->is_published):?>
        <p>Данный тест еще не опубликован</p>
    <? else: ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'email')->hint('Это поле является необязательным') ?>
    <? endif;?>

    <?= $form->field($model, 'password') ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary view-submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>

<? $this->registerJsVar('is_published', $test->is_published, static::POS_BEGIN); ?>
<? $this->registerJsFile(Yii::getAlias('@web') . '/js/view.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>