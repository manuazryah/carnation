<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HomeCategory;

/**
 * HomeCategorySearch represents the model behind the search form about `common\models\HomeCategory`.
 */
class HomeCategorySearch extends HomeCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'UB'], 'integer'],
            [['title1', 'url1', 'image', 'title2', 'url2', 'image2', 'title3', 'url3', 'image3', 'title4', 'url4', 'image4', 'DOU'], 'safe'],
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
        $query = HomeCategory::find();

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
            'UB' => $this->UB,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'title1', $this->title1])
            ->andFilterWhere(['like', 'url1', $this->url1])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'title2', $this->title2])
            ->andFilterWhere(['like', 'url2', $this->url2])
            ->andFilterWhere(['like', 'image2', $this->image2])
            ->andFilterWhere(['like', 'title3', $this->title3])
            ->andFilterWhere(['like', 'url3', $this->url3])
            ->andFilterWhere(['like', 'image3', $this->image3])
            ->andFilterWhere(['like', 'title4', $this->title4])
            ->andFilterWhere(['like', 'url4', $this->url4])
            ->andFilterWhere(['like', 'image4', $this->image4]);

        return $dataProvider;
    }
}
