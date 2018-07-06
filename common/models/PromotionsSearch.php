<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Promotions;

/**
 * PromotionsSearch represents the model behind the search form about `common\models\Promotions`.
 */
class PromotionsSearch extends Promotions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'promotion_type', 'product_id', 'user_id', 'type', 'time', 'status', 'CB', 'UB'], 'integer'],
            [['promotion_code', 'amount_range', 'starting_date', 'expiry_date', 'DOC', 'DOU'], 'safe'],
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
        $query = Promotions::find();

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
            'promotion_type' => $this->promotion_type,
            'product_id' => $this->product_id,
            'user_id' => $this->user_id,
            'type' => $this->type,
            'time' => $this->time,
            'starting_date' => $this->starting_date,
            'expiry_date' => $this->expiry_date,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'promotion_code', $this->promotion_code])
            ->andFilterWhere(['like', 'amount_range', $this->amount_range]);

        return $dataProvider;
    }
}
