<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OrderDetails;

/**
 * OrderDetailsSearch represents the model behind the search form about `common\models\OrderDetails`.
 */
class OrderDetailsSearch extends OrderDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'master_id', 'product_id', 'quantity', 'status'], 'integer'],
            [['order_id', 'delivered_date', 'doc'], 'safe'],
            [['amount', 'rate'], 'number'],
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
        $query = OrderDetails::find();

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
            'master_id' => $this->master_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'delivered_date' => $this->delivered_date,
            'rate' => $this->rate,
            'doc' => $this->doc,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'order_id', $this->order_id]);

        return $dataProvider;
    }
}
