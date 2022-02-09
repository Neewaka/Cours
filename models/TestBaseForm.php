<?php

namespace app\models;

use Yii;
use yii\base\Model;

class TestBaseForm extends Model
{
    public $name;
    public $password;

    public function rules()
    {
        return [
            [['name', 'password'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Test name',
            'password' => 'Password',
        ];
    }

    public function createTest()
    {
        $test = new Test();
        $test->title = $this->name;
        $test->created_by = Yii::$app->user->identity->id;
        $test->hash_link = $this->makeHash(20);
        $test->password = $this->password;
        $test->is_published = 0;

        if ($test->save()) {
            return $test;
        }

        var_dump($test->errors);
        die;

        return false;
    }

    protected function makeHash($len=32)
    {
        return substr(md5(openssl_random_pseudo_bytes(20)),-$len);
    }
}
