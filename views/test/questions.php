<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use app\components\QuestieWidget;
?>

<h2 class="page-name">Вопросы</h2>
<!-- <?php $form = ActiveForm::begin(['id' => 'questions-form']); ?>
<div class="questions">
    <? foreach ($items as $key => $item) : ?>
        <div class="question-box container m-3">
            <div class="row">
                <div class="col-11 question-form" style="box-shadow: 0 0 10px 0px #bdbdbd; display:inline-block">
                    <?= $form->field($item, "[$key]choices")->hiddenInput(['class' => 'choices-form'])->label(false) ?>
                    <?= $form->field($item, "[$key]question") ?>

                    <div class="container">
                        <?=
                        $form->field($item, "[$key]answer")->radioList(
                            $item->choices,
                            ['class' => 'compactRadioGroup', 'item' => function ($index, $label, $name, $checked, $value) use ($item) {
                                if ($label == $item->answer) {
                                    $checked = true;
                                }
                                return '<div class="label-q" style="display: flex">' .
                                    Html::radio($name, $checked, ['value'  => $value, 'style' => 'margin-top: 5px']) .
                                    Html::tag('p', $label, ['class' => 'question-label ml-2 mb-0', 'contenteditable' => true]) .
                                    Html::tag('div', '-', ['class' => 'label-delete btn btn-danger']) . '</div>';
                            }]
                        )->label(false) ?>

                        <p class="btn form-add-choice"><u>добавить еще один вариант...</u></p>
                    </div>
                </div>
                <div class="btn btn-danger form-delete col-1" style="box-shadow: 0 0 10px 0px #bdbdbd; vertical-align: middle;">X</div>
            </div>

        </div>
    <? endforeach; ?>
</div>

<div class="btn btn-success btn-block m-3 form-add-question">Добавить вопрос</div>

<hr class="m-3">

<div class="form-group row justify-content-md-center">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary m-3 col-4']) ?>
</div>

<?php ActiveForm::end(); ?> -->



<?php Pjax::begin(['enablePushState' => false, 'timeout' => 5000, 'id' => 'block-pjax']); ?>
<? $form = QuestieWidget::begin(['dada' => 'net']); ?>
<?= $form->viewQuestions($items); ?>
<? QuestieWidget::end(); ?>
<?php Pjax::end(); ?>



<? $this->registerJsFile(Yii::getAlias('@web') . '/js/questions.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>
<? $this->registerJsFile(Yii::getAlias('@web') . '/js/menu.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>