<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Bottle;

/**
 * BottleSearch represents the model behind the search form about `common\models\Bottle`.
 */
class BottleSearch extends Bottle {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['id', 'status', 'CB', 'UB'], 'integer'],
			[['name', 'bottle_img', 'desigin_img', 'DOC', 'DOU', 'price'], 'safe'],
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
		$query = Bottle::find();

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

		$query->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'bottle_img', $this->bottle_img])
			->andFilterWhere(['like', 'desigin_img', $this->desigin_img]);

		return $dataProvider;
	}

}
