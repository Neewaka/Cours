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

<?= Html::tag('h1', $scoreTitle . $studentResults, ['class' => 'text-center mb-5']) ?>

<?php $form = ActiveForm::begin(['id' => 'questions-form']); ?>
<div class="questions">
    <? foreach ($items as $key => $item) : ?>

        <? $mistake = $studentAnswers[$key]->correct ? '' : 'mistake'; ?>

        <div class="question-box container <?= $mistake ?> mb-3">
            <div class="row">
                <div class="col-12 question-form">
                    <?= $form->field($item, "[$key]choices")->hiddenInput(['class' => 'choices-form'])->label(false) ?>
                    <b>
                        <div class="control-label mb-3"></div>
                    </b>
                    <div class="student-question">
                        <div class="student-question__name"><?= $item->question ?></div>
                    </div>

                    <div class="container">
                        <?
                        switch ($item->type) {
                            case '1':
                                echo $this->render('/result/question', ['form' => $form, 'item' => $item, 'key' => $key, 'studentAnswers' => $studentAnswers]);
                                break;
                            case '2':
                                echo $this->render('/result/question_multiple', ['form' => $form, 'item' => $item, 'key' => $key, 'studentAnswers' => $studentAnswers]);
                                break;
                            case '3':
                                echo $this->render('/result/question_trueFalse', ['form' => $form, 'item' => $item, 'key' => $key, 'studentAnswers' => $studentAnswers]);
                                break;
                            case '4':
                                echo $this->render('/result/question_fill', ['form' => $form, 'item' => $item, 'key' => $key, 'studentAnswers' => $studentAnswers]);
                                break;
                        }
                        ?>
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