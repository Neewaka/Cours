<?php
/* @var $this yii\web\View */

use Codeception\PHPUnit\ResultPrinter\HTML as ResultPrinterHTML;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap4\Modal;
?>

<h1>Тест <b><?= $test->title ?></b></h1>
<p>Пользователь: <b><?= $studentName ?></b></p>


<? if($time): ?>
<div id="noDays"></div>
<p class="text-center m-2">По истечению времени на прохождение теста, ваши ответы будут сохранены автоматичеки</p>
<? endif; ?>


<?php $form = ActiveForm::begin(['id' => 'questions-form']); ?>

<div class="questions">
    <? foreach ($items as $key => $item) : ?>
        <? $item->answer = ''; ?>
        <div class="question-box container m-3">
            <div class="row">
                <div class="col-12 question-form" style="box-shadow: 0 0 10px 0px #bdbdbd; display:inline-block">
                    <?= $form->field($item, "[$key]choices")->hiddenInput(['class' => 'choices-form'])->label(false) ?>
                    <b>
                        <div class="control-label mb-3"></div>
                    </b>
                    <div class="student-form">
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

        </div>
    <? endforeach; ?>
</div>


<div class="form-group row justify-content-md-center">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary m-3 col-4 data-blocked', 'id' => 'student-submit']) ?>
</div>

<?php ActiveForm::end(); ?>


<?

Modal::begin([
    'id' => 'studentModal',
    'title' => 'Вы уверены, что хотите продолжить?',
    'footer' => Html::button('Продолжить', ['class' => 'btn btn-primary', 'id' => 'student-confirm']) . Html::button('Отмена', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal']),
]);

echo 'Вы не ответили на следующие вопросы:';
echo Html::tag('div','',['id' => 'modalBody', 'class' => 'modalBody']);

Modal::end();

?>

<? if($time){ $this->registerJsVar('testTime', $time); } ?>
<? $this->registerJsFile(Yii::getAlias('@web') . '/js/countdown/jquery.plugin.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>
<? $this->registerJsFile(Yii::getAlias('@web') . '/js/countdown/jquery.countdown.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>
<? $this->registerJsFile(Yii::getAlias('@web') . '/js/countdown/jquery.countdown-ru.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>
<? $this->registerJsFile(Yii::getAlias('@web') . '/js/student.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>