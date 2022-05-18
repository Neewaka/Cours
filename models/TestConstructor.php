<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\components\QuestieWidget;


class TestConstructor extends Model
{

    public static $form;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // // username and password are both required
            // [['login', 'password'], 'required'],
            // // rememberMe must be a boolean value
            // ['rememberMe', 'boolean'],
            // // password is validated by validatePassword()
            // ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            // 'login' => 'Логин',
            // 'password' => 'Пароль',
            // 'rememberMe' => 'Запомнить меня'           
        ];
    }

    public static function renderQuestionsForm($items)
    {
        $form = QuestieWidget::begin(); 
        $form->viewQuestions($items); 
        QuestieWidget::end();

    }

    public static function renderQuestion()
    {
        $form = QuestieWidget::begin(); 
        // $form->question(); 
        QuestieWidget::end();
        return self::$form->question();
    }

}
