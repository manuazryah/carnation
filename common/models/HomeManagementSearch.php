<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HomeManagement;

/**
 * HomeManagementSearch represents the model behind the search form about `common\models\HomeManagement`.
 */
class HomeManagementSearch extends HomeManagement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'sort_order'], 'integer'],
            [['heading', 'products', 'image'], 'safe'],
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
        $query = HomeManagement::find();

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
            'type' => $this->type,
            'sort_order' => $this->sort_order,
        ]);

        $query->andFilterWhere(['like', 'heading', $this->heading])
            ->andFilterWhere(['like', 'products', $this->products])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
