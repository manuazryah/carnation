<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CreateYourOwn;

/**
 * CreateYourOwnSearch represents the model behind the search form about `common\models\CreateYourOwn`.
 */
class CreateYourOwnSearch extends CreateYourOwn {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'user_id', 'gender', 'character_id', 'scent', 'bottle', 'status'], 'integer'],
            [['session_id', 'note', 'label_1', 'label_2'], 'safe'],
            [['tot_amount'], 'number'],
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
        $query = CreateYourOwn::find();

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
            'gender' => $this->gender,
            'character_id' => $this->character_id,
            'scent' => $this->scent,
            'bottle' => $this->bottle,
            'tot_amount' => $this->tot_amount,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'session_id', $this->session_id])
                ->andFilterWhere(['like', 'note', $this->note])
                ->andFilterWhere(['like', 'label_1', $this->label_1])
                ->andFilterWhere(['like', 'label_2', $this->label_2]);

        return $dataProvider;
    }

}
