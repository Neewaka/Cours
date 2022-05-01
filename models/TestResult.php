<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_result".
 *
 * @property int $id
 * @property int $test_id
 * @property string $name
 * @property string $date
 * @property string|null $email
 * @property string $result
 *
 * @property Test $test
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
            [['test_id', 'name', 'result'], 'required'],
            [['test_id'], 'integer'],
            [['date'], 'safe'], 
            [['result'], 'string'],
            [['name', 'email'], 'string', 'max' => 255],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_id' => 'id']],
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
            'name' => 'Имя',
            'date' => 'Дата прохождения', 
            'email' => 'Email',
            'result' => 'Результат',
        ];
    }

    /**
     * Gets query for [[Test]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }
}
