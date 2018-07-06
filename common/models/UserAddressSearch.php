<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserAddress;

/**
 * UserAddressSearch represents the model behind the search form about `common\models\UserAddress`.
 */
class UserAddressSearch extends UserAddress {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'user_id', 'emirate', 'post_code', 'status', 'CB', 'UB'], 'integer'],
            [['name', 'address', 'landmark', 'location', 'mobile_number', 'DOC', 'DOU', 'country_code'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = UserAddress::find();

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
            'emirate' => $this->emirate,
            'post_code' => $this->post_code,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'address', $this->address])
                ->andFilterWhere(['like', 'landmark', $this->landmark])
                ->andFilterWhere(['like', 'location', $this->location])
                ->andFilterWhere(['like', 'mobile_number', $this->mobile_number]);

        return $dataProvider;
    }

}
