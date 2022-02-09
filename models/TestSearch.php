<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Test;

/**
 * TestrSearch represents the model behind the search form of `app\models\Test`.
 */
class TestSearch extends Test
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'is_published'], 'integer'],
            [['title', 'subject', 'created_at', 'test_body', 'hash_link', 'password'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Test::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'is_published' => $this->is_published,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'test_body', $this->test_body])
            ->andFilterWhere(['like', 'hash_link', $this->hash_link])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['created_by' => \Yii::$app->user->identity->id])
            ->orderBy(['created_at' => SORT_DESC]);

        return $dataProvider;
    }
}
