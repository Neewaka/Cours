<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>


<h2 class="page-name">Публикация</h2>

<? if (!$model->is_published) : ?>

    <p>Вам нужно опубликовать ваш тест, чтобы дать людям возможность для его прохождения</p>

    <?php $form = ActiveForm::begin(['id' => 'test-form']); ?>

    <h3>Готовы к публикации?</h3>
    <div class="form-group text-center">
        <?= Html::submitButton('Да, опубликовать мой тест', ['class' => 'btn btn-primary view-submit btn-lg']) ?>
    </div>
    <?php ActiveForm::end(); ?>

<? else : ?>

    <? $url = Url::to(['test/view', 'hash_link' => $model->hash_link], true) ?>
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
            <h2 class="display-4">Ваш тест опубликован и доступен по адресу:</h1>
                <hr>
                <p class="lead"><?= Html::a($url, $url) ?></p>
        </div>
    </div>

    <?php $form = ActiveForm::begin(['id' => 'test-form']); ?>

    <div class="form-group text-center">
        <?= Html::submitButton('Снова сделать мой тест приватным', ['class' => 'btn btn-danger view-submit btn-lg']) ?>
    </div>
    <?php ActiveForm::end(); ?>

<? endif; ?>


<? $this->registerJsFile(Yii::getAlias('@web') . '/js/menu.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>