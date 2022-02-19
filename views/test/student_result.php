<?php
/* @var $this yii\web\View */

use Codeception\PHPUnit\ResultPrinter\HTML as ResultPrinterHTML;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h1><?= $test->title ?></h1>
<p>Student: <?= $studentName ?></p>

<? $true = substr_count($testResult->result, 'true');
$count = explode(',', $testResult->result);
$studentResults = $true . '/' . count($count); ?>

<?= Html::tag('h1', 'Your score: ' . $studentResults, ['class' => 'text-center']) ?>

<?php $form = ActiveForm::begin(['id' => 'questions-form']); ?>
<div class="questions">
    <? foreach ($items as $key => $item) : ?>
        <div class="question-box container m-3">
            <div class="row">
                <div class="col-12 question-form" style="box-shadow: 0 0 10px 0px #bdbdbd; display:inline-block">
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
                                if ($item->answer == $label) {
                                    $style = 'style="background-color: green"';
                                } else if ($label == $studentAnswers[$key]) {
                                    $style = 'style="background-color: red"';
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

<div class="form-group row justify-content-md-center">
    <?= Html::a('Logout', '/',  ['class' => 'btn btn-primary m-3 col-4']) ?>
</div>

<?php ActiveForm::end(); ?>

<? $this->registerJsFile(Yii::getAlias('@web') . '/js/questions.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>