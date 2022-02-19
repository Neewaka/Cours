<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<h2 class="page-name">Publish</h2>

<? if (!$model->is_published) : ?>

    <p>You need to publish your test to make it available for your students to take.</p>

    <?php $form = ActiveForm::begin(['id' => 'test-form']); ?>

    <h3>Ready to publish?</h3>
    <div class="form-group text-center">
        <?= Html::submitButton('Yes, make it public', ['class' => 'btn btn-primary view-submit btn-lg']) ?>
    </div>
    <?php ActiveForm::end(); ?>

<? else : ?>

    <? $url = Url::to(['test/view', 'hash_link' => $model->hash_link], true) ?>
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
            <h2 class="display-4">Your test is published and available at:</h1>
                <hr>
                <p class="lead"><?= Html::a($url, $url) ?></p>
        </div>
    </div>

<? endif; ?>


<? $this->registerJsFile(Yii::getAlias('@web') . '/js/menu.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>