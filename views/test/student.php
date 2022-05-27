<?php
/* @var $this yii\web\View */

use Codeception\PHPUnit\ResultPrinter\HTML as ResultPrinterHTML;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h1>Тест <b><?= $test->title ?></b></h1>
<p>Пользователь: <b><?= $studentName ?></b></p>

<?php $form = ActiveForm::begin(['id' => 'questions-form']); ?>
<div class="questions">
    <? foreach ($items as $key => $item) : ?>
        <? $item->answer = '';?>
        <div class="question-box container m-3">
            <div class="row">
                <div class="col-12 question-form" style="box-shadow: 0 0 10px 0px #bdbdbd; display:inline-block">
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
                                echo $this->render('/question/question', ['form' => $form, 'item' => $item, 'key' => $key]);
                                break;
                            case '2':
                                echo $this->render('/question/question_multiple', ['form' => $form, 'item' => $item, 'key' => $key]);
                                break;
                            case '3':
                                echo $this->render('/question/question_trueFalse', ['form' => $form, 'item' => $item, 'key' => $key]);
                                break;
                            case '4':
                                echo $this->render('/question/question_fill', ['form' => $form, 'item' => $item, 'key' => $key]);
                                break;
                        } ?>
                    </div>
                </div>
            </div>

        </div>
    <? endforeach; ?>
</div>


<div class="form-group row justify-content-md-center">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary m-3 col-4']) ?>
</div>

<?php ActiveForm::end(); ?>

<? $this->registerJsFile(Yii::getAlias('@web') . '/js/questions.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>