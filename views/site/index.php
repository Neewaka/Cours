<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

    </div>

    <div class="body-content">

        <?= Html::a('Create new test', ['test/create'], ['class' => 'btn btn-primary btn-block btn-lg']) ?>
        <div class="viewOr">or</div>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'hash_link')->textInput(['class' => 'form-control text-center'])->label(false) ?>

        <div class="form-group text-center">
            <?= Html::submitButton('Open an existing test', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>