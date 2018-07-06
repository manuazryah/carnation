<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Showrooms;

/**
 * ShowroomsSearch represents the model behind the search form about `common\models\Showrooms`.
 */
class ShowroomsSearch extends Showrooms {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['id', 'status', 'CB', 'UB'], 'integer'],
			[['title', 'address', 'email', 'image', 'map', 'DOC', 'DOU'], 'safe'],
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
		$query = Showrooms::find();

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
		    'status' => $this->status,
		    'CB' => $this->CB,
		    'UB' => $this->UB,
		    'DOC' => $this->DOC,
		    'DOU' => $this->DOU,
		]);

		$query->andFilterWhere(['like', 'title', $this->title])
			->andFilterWhere(['like', 'address', $this->address])
			->andFilterWhere(['like', 'email', $this->email])
			->andFilterWhere(['like', 'image', $this->image])
			->andFilterWhere(['like', 'map', $this->map]);

		return $dataProvider;
	}

}
