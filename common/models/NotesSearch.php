<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Notes;

/**
 * NotesSearch represents the model behind the search form about `common\models\Notes`.
 */
class NotesSearch extends Notes {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'status', 'CB', 'UB'], 'integer'],
            [['scent_id', 'notes', 'description', 'DOC', 'DOU', 'main_img', 'sub_img'], 'safe'],
            [['price'], 'number'],
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
        $query = Notes::find();

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
            'price' => $this->price,
            'main_img' => $this->main_img,
            'sub_img' => $this->sub_img,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'scent_id', $this->scent_id])
                ->andFilterWhere(['like', 'notes', $this->notes])
                ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

}
