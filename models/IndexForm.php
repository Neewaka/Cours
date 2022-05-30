<?php

namespace app\models;

use Yii;
use yii\base\Model;

class IndexForm extends Model
{
    public $hash_link;

    public function rules()
    {
        return [
            [['hash_link'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'hash_link' => 'Код теста',
        ];
    }

}
