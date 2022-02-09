<?php

namespace app\models;

use Yii;
use yii\base\Model;

class QuestionForm extends Model
{
    public $question;
    public $answer;

    public function rules()
    {
        return [
            [['question', 'answer'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'question' => 'question',
            'answer' => 'answer',
        ];
    }
    
}
