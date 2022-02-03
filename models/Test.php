<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property string $title
 * @property string $subject
 * @property int $created_by
 * @property string $created_at
 * @property string $test_body
 * @property string $hash_link
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
            [['title', 'subject', 'created_by', 'test_body', 'hash_link'], 'required'],
            [['created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['test_body'], 'string'],
            [['title', 'subject', 'hash_link'], 'string', 'max' => 255],
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
        ];
    }
}
