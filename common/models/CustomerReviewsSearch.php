<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CustomerReviews;

/**
 * CustomerReviewsSearch represents the model behind the search form about `common\models\CustomerReviews`.
 */
class CustomerReviewsSearch extends CustomerReviews
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'product_id', 'status'], 'integer'],
            [['tittle', 'description', 'review_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = CustomerReviews::find();

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
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'review_date' => $this->review_date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'tittle', $this->tittle])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
