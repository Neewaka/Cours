<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?=Yii::$app->session->getFlash('success')?>

<h2 class="page-name">Settings</h2>

<?php $form = ActiveForm::begin(['id' => 'test-form']); ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'subject') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary view-submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <? $this->registerJsFile(Yii::getAlias('@web') . '/js/menu.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>