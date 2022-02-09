<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>




<?php $form = ActiveForm::begin(['id' => 'questions-form']); ?>

<? foreach ($things as $key => $item) : ?>
    <?= $form->field($model, 'question')->textInput(['data-id'=>++$key]) ?>

    <?= $form->field($model, 'answer') ?>
<? endforeach; ?>

<?php ActiveForm::end(); ?>

<button id="button">push</button>

<? $this->registerJsFile(Yii::getAlias('@web') . '/js/questions.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>