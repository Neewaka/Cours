<?php

namespace app\models;

use Yii;
use yii\base\Model;

class QuestionForm extends Model
{

    public $question;
    public $choices;
    public $answer;
    public $type;

    // public function rules()
    // {
    //     return [
    //         [['answer'], 'required', 'message' => 'Необходимо ответить на вопрос!', 'except' => self::SCENARIO_NO_VALIDATION],
    //     ];
    // }

    public function attributeLabels()
    {
        return [
            'question' => 'question',
            'answer' => 'Ответ',
            'choices' => 'choices',
        ];
    }

    public static function createExampleTest($type)
    {
        switch ($type) {
            case '1':
                return self::createSimpleTest();
                break;
            case '2':
                return self::createMultipleTest();
                break;
            case '3':
                return self::createTrueFalseTest();
                break;
            case '4':
                return self::createFillTest();
                break;
        }
    }

    protected static function createSimpleTest()
    {
        $example = new QuestionForm();
        $example->question = 'Вопрос';
        $example->choices = ['Выбор 1', 'Выбор 2', 'Выбор 3', 'Выбор 4'];
        $example->type = 1;
        $example->answer = 'Выбор 1';
        return $example;
    }

    protected static function createMultipleTest()
    {
        $example = new QuestionForm();
        $example->question = 'Вопрос';
        $example->choices = ['Выбор 1', 'Выбор 2', 'Выбор 3', 'Выбор 4'];
        $example->type = 2;
        $example->answer = ['Выбор 1', 'Выбор 2'];
        return $example;
    }

    protected static function createTrueFalseTest()
    {
        $example = new QuestionForm();
        $example->question = 'Вопрос';
        $example->choices = ['Правда', 'Неправда'];
        $example->type = 3;
        $example->answer = ['Правда'];
        return $example;
    }

    protected static function createFillTest()
    {
        $example = new QuestionForm();
        $example->question = 'Вопрос';
        $example->type = 4;
        $example->answer = '';
        return $example;
    }

    public static function unpackTest($testBody)
    {
        $testArray = json_decode($testBody);
        $result = [];
        $time = null;
        $need = null;

        foreach ($testArray as $index => $item) {
            
            if($index == 'test-time-need')
            {
                $need = $item;
                continue;
            }

            if($index == 'test-time')
            {
                $time = $item;
                continue;
            }

            $test = new QuestionForm();
            $test->answer = $item->answer;
            $test->choices = explode(',', $item->choices);
            $test->question = $item->question;
            $test->type = $item->type;
            $result[] = $test;
        }


        return ['time' => $time,'time-need' => $need,'items' => $result];
    }

    public static function getResults($form, $items)
    {
    

        $result = [];
            foreach ($form as $key => $item) {

                if(is_array($items[$key]->answer))
                {
                    $result[] = ['given' => $item['answer'], 'correct' => $items[$key]->answer == $item['answer'] ? 1 : 0];
                } else {
                    $result[] = ['given' => $item['answer'], 'correct' => $items[$key]->answer == $item['answer'] ? 1 : 0];
                }       
            }  

        return $result;
    }

    public static function getFormErrors($form)
    {
        $errors = [];
        foreach($form as $index => $item){
            if($item['answer'] == '')
            {
                $errors[] = $index;
            }
        }

        return $errors;
    }
}
