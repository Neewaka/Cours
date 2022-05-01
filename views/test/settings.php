<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<?= Yii::$app->session->getFlash('success') ?>

<h2 class="page-name">Настройки</h2>

<?php $form = ActiveForm::begin(['id' => 'test-form']); ?>

<?= $form->field($model, 'title') ?>

<?= $form->field($model, 'subject') ?>

<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary view-submit']) ?>
    <div class="btn btn-danger float-right button-delete">Удалить тест</div>
</div>


<?php ActiveForm::end(); ?>

<div class="modal" tabindex="-1" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Вы действительно хотите удалить данный тест?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Это действие будет невозможно отменить</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <?=
                Html::a('Удалить', Url::to(['test/' . $model->hash_link . '/delete']), ['method' => 'post', 'class'=> 'btn btn-danger']) ?>

            </div>
        </div>
    </div>



    <? $this->registerJsFile(Yii::getAlias('@web') . '/js/menu.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>
    <? $this->registerJsFile(Yii::getAlias('@web') . '/js/settings.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>