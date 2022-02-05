<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property string $title
 * @property string|null $subject
 * @property int $created_by
 * @property string $created_at
 * @property string|null $test_body
 * @property string $hash_link
 * @property string $password
 * @property int $is_published
 *
 * @property User $createdBy
 * @property TestResult[] $testResults
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'created_by', 'hash_link', 'password', 'is_published'], 'required'],
            [['created_by', 'is_published'], 'integer'],
            [['created_at'], 'safe'],
            [['test_body'], 'string'],
            [['title', 'subject', 'hash_link', 'password'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'subject' => 'Subject',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'test_body' => 'Test Body',
            'hash_link' => 'Hash Link',
            'password' => 'Password',
            'is_published' => 'Is Published',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[TestResults]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestResults()
    {
        return $this->hasMany(TestResult::className(), ['test_id' => 'id']);
    }
}
