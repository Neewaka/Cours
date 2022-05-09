<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\Pjax;
use app\components\QuestieWidget;
?>

<?php Pjax::begin(['enablePushState' => false, 'timeout' => 5000, 'id' => 'block-pjax']); ?>

<?= Html::beginTag('div', ['class' => 'questions-ajax']) ?>
<? $form = QuestieWidget::begin(['dada' => 'net']); ?>
<?= $form->viewQuestions($items); ?>
<? QuestieWidget::end(); ?>
<?= Html::beginTag('div', ['class' => 'questions-ajax']) ?>


<?php Pjax::end(); ?>
