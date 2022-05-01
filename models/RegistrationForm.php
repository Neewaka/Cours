<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class RegistrationForm extends Model
{
    public $login;
    public $email;
    public $password;
    public $password_repeat;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['login', 'email', 'password'], 'required'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['login', 'unique', 'targetClass' => User::class],
            // email has to be a valid email address
            ['email', 'email'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'password_repeat' => 'Подтверждение пароля',
            'login' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Email',
        ];
    }

    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            $user->login = $this->login;
            $user->email = $this->email;
            $user->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $user->auth_key = \Yii::$app->security->generateRandomString();
            $user->role_id = Role::getIdByName('user');

            if($user->save())
            {
                return $user;
            }
        }

        return false;
    }
}
