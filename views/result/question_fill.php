
<?php

use yii\helpers\Html;


$style = $studentAnswers[$key]->correct ? 'style="background-color: green; margin-bottom: 1rem;"' : 'style="background-color: red; margin-bottom: 1rem;"';
echo '<div class="label-q" ' . $style . '">' . Html::tag('p', $studentAnswers[$key]->given, ['class' => 'question-label ml-2 mb-0']) . '</div>';


?>