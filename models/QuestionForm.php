<?php

namespace app\models;

use Yii;
use yii\base\Model;

class QuestionForm extends Model
{
    public $question;
    public $choices;
    public $answer;

    public function rules()
    {
        return [
            [['answer'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'question' => 'question',
            'answer' => 'answer',
            'choices' => 'choices',
        ];
    }
    
}
