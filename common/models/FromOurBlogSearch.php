<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FromOurBlog;

/**
 * FromOurBlogSearch represents the model behind the search form about `common\models\FromOurBlog`.
 */
class FromOurBlogSearch extends FromOurBlog {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['id', 'status', 'CB', 'UB'], 'integer'],
			[['title', 'meta_title', 'meta_description', 'meta_keyword', 'blog_date', 'content', 'image', 'DOC', 'DOU', 'featured'], 'safe'],
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
		$query = FromOurBlog::find();

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
		    'blog_date' => $this->blog_date,
		    'status' => $this->status,
		    'CB' => $this->CB,
		    'UB' => $this->UB,
		    'DOC' => $this->DOC,
		    'DOU' => $this->DOU,
		]);

		$query->andFilterWhere(['like', 'title', $this->title])
			->andFilterWhere(['like', 'meta_title', $this->meta_title])
			->andFilterWhere(['like', 'canonical_name', $this->canonical_name])
			->andFilterWhere(['like', 'meta_description', $this->meta_description])
			->andFilterWhere(['like', 'meta_keyword', $this->meta_keyword])
			->andFilterWhere(['like', 'content', $this->content])
                        ->andFilterWhere(['like', 'featured', $this->featured])
			->andFilterWhere(['like', 'image', $this->image]);

		return $dataProvider;
	}

}
