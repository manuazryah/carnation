<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SubCategory;

/**
 * SubCategorySearch represents the model behind the search form about `common\models\SubCategory`.
 */
class SubCategorySearch extends SubCategory {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'main_category', 'category_id', 'CB', 'UB', 'status'], 'integer'],
            [['sub_category', 'DOC', 'DOU'], 'safe'],
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
        $query = SubCategory::find();

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
            'main_category' => $this->main_category,
            'category_id' => $this->category_id,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'sub_category', $this->sub_category]);

        return $dataProvider;
    }

}
