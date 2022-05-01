<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\widgets\Pjax;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">



    <h1><?= Html::encode($this->title) ?></h1>
    <p>Пожалуйста заполните следующие поля для регистрации: </p>

        <div class="row">
            <div class="col-lg-5">

                <?php Pjax::begin(['enablePushState' => false, 'enableReplaceState' => false, 'timeout' => 5000]); ?>
                
                    <?php $form = ActiveForm::begin(['id' => 'registration-form', 'options' => ['data-pjax' => true]]); ?>

                        <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'email') ?>

                        <?= $form->field($model, 'password') ?>

                        <?= $form->field($model, 'password_repeat') ?>

                        <div class="form-group">
                            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'registration-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>

                <?php Pjax::end(); ?>

            </div>
        </div>

</div>
