<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_result".
 *
 * @property int $id
 * @property int $test_id
 * @property string $name
 * @property string $email
 * @property string $result
 */
class TestResult extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test_result';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_id', 'name', 'email', 'result'], 'required'],
            [['test_id'], 'integer'],
            [['result'], 'string'],
            [['name', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_id' => 'Test ID',
            'name' => 'Name',
            'email' => 'Email',
            'result' => 'Result',
        ];
    }
}
