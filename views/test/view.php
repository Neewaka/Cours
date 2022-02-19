<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Test */

?>

<ul class="list-group list-group-horizontal">
    <li class="list-group-item"><button id='role-student' class="btn btn-secondary btn-lg active">Student</button></li>
    <li class="list-group-item"><button id='role-admin' class="btn btn-secondary btn-lg ">Administration</button></li>
</ul>

<div class="jumbotron view-jumbotron">

    <h1 class="display-4">Test <?= $this->context->testInfo->title ?></h1>

    <? if($test->subject):?>
        <p><?= $test->subject ?></p>
    <? else: ?>
        <p class="lead">This test has no subject</p>
    <? endif;?>
    
    <hr class="my-4">
    
    <?php $form = ActiveForm::begin(['id' => 'test-form']); ?>

    <? if(!$test->is_published):?>
        <p>This test is not yet published</p>
    <? else: ?>
        <?= $form->field($model, 'name') ?>
    <? endif;?>

    <?= $form->field($model, 'password') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary view-submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>

<? $this->registerJsVar('is_published', $test->is_published, static::POS_BEGIN); ?>
<? $this->registerJsFile(Yii::getAlias('@web') . '/js/view.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>