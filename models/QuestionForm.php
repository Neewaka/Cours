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

    public function createExampleTest()
    {
        $example = new QuestionForm();
        $example->question = 'Вопрос';
        $example->choices = ['Выбор 1', 'Выбор 2', 'Выбор 3', 'Выбор 4'];
        return $example;
    }

    public static function unpackTest($testBody)
    {
        $testArray = json_decode($testBody);
        $result = [];

        // var_dump($testArray);die;

        foreach ($testArray as $item) {
            $test = new QuestionForm();
            $test->answer = $item->answer;
            $test->choices = explode(',', $item->choices);
            $test->question = $item->question;
            $result[] = $test;
        }

        return $result;
    }
    
}
