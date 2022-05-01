<?php
/* @var $this yii\web\View */

use Codeception\PHPUnit\ResultPrinter\HTML as ResultPrinterHTML;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<? if (!$ajax) : ?>
    <h1><?= $test->title ?></h1>
<? endif; ?>

<p>Студент: <?= $studentName ?></p>

<?
$answers = array_count_values(array_column($studentAnswers, 'correct'));
$studentResults = $answers[1] ?? 0 . '/' . ($answers[1] + $answers[0]);

if ($ajax) {
    $scoreTitle = 'Результат: ';
} else {
    $scoreTitle = 'Ваш результат: ';
}
?>

<?= Html::tag('h1', $scoreTitle . $studentResults, ['class' => 'text-center']) ?>

<?php $form = ActiveForm::begin(['id' => 'questions-form']); ?>
<div class="questions">
    <? foreach ($items as $key => $item) : ?>
        <div class="question-box container mb-3">
            <div class="row">
                <div class="col-12 question-form">
                    <?= $form->field($item, "[$key]choices")->hiddenInput(['class' => 'choices-form'])->label(false) ?>
                    <div class="student-question">
                        <div class="control-label"></div>
                        <div class="student-question__name"><?= $item->question ?></div>
                    </div>

                    <div class="container">
                        <?=
                        $form->field($item, "[$key]answer")->radioList(
                            $item->choices,
                            ['class' => 'compactRadioGroup', 'item' => function ($index, $label, $name, $checked, $value) use ($item, $studentAnswers, $key) {
                                $studetnAnswer = mb_substr($studentAnswers[$key]->given, 1);
                                if ($studetnAnswer == $label) {
                                    if ($studetnAnswer == $item->answer) {
                                        $style = 'style="background-color: green"';
                                    } else {
                                        $style = 'style="background-color: red"';
                                    }
                                }

                                return '<div class="label-q" ' . $style . '">' .
                                    Html::tag('p', $label, ['class' => 'question-label ml-2 mb-0']) . '</div>';
                            }]
                        )->label(false) ?>
                    </div>
                </div>
            </div>

        </div>
    <? endforeach; ?>
</div>

<!-- <hr class="m-3"> -->

<? if (!$ajax) : ?>
    <div class="form-group row justify-content-md-center">
        <?= Html::a('Выйти', '/',  ['class' => 'btn btn-primary m-3 col-4']) ?>
    </div>
<? endif; ?>

<?php ActiveForm::end(); ?>

<? $this->registerJsFile(Yii::getAlias('@web') . '/js/questions.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>