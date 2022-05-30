<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use app\models\TestConstructor;
use app\components\QuestieWidget;
?>

<h2 class="page-name">Вопросы</h2>

<?

$form = QuestieWidget::begin();
$form->viewQuestions($items);
QuestieWidget::end(); 

?>



<? $this->registerJsVar('questionsForm', json_encode($form), static::POS_END) ?>
<? $this->registerJsFile(Yii::getAlias('@web') . '/js/questions.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>
<? $this->registerJsFile(Yii::getAlias('@web') . '/js/menu.js', ['depends' => [\yii\web\YiiAsset::class], 'position' => static::POS_END]) ?>