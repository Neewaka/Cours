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

<div class="jumbotron">

    <h1 class="display-4">Test <?= $this->context->testInfo->title ?></h1>
    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
    <hr class="my-4">
    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <?php $form = ActiveForm::begin(['id' => 'test-form']); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'password') ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>


<? $this->registerJsFile(Yii::getAlias('@web') . '/js/view.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>