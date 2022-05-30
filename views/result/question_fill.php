
<?php

use yii\helpers\Html;


if($studentAnswers[$key]->given == '')
{
    $answer = '<нет ответа>';
    $style = 'style=" margin-bottom: 1rem;"';
} else {
    $answer = $studentAnswers[$key]->given;
    $style = $studentAnswers[$key]->correct ? 'style="background-color: green; margin-bottom: 1rem;"' : 'style="background-color: red; margin-bottom: 1rem;"';
}

echo '<div class="label-q" ' . $style . '">' . Html::tag('p',$answer , ['class' => 'question-label ml-2 mb-0']) . '</div>';


?>