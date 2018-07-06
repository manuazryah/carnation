<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ContactPage;

/**
 * ContactPageSearch represents the model behind the search form about `common\models\ContactPage`.
 */
class ContactPageSearch extends ContactPage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['map', 'content', 'accounts_info', 'administration_info', 'marketing_info', 'business_info', 'marketing_address', 'date_1'], 'safe'],
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
        $query = ContactPage::find();

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
        ]);

        $query->andFilterWhere(['like', 'map', $this->map])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'accounts_info', $this->accounts_info])
            ->andFilterWhere(['like', 'administration_info', $this->administration_info])
            ->andFilterWhere(['like', 'marketing_info', $this->marketing_info])
            ->andFilterWhere(['like', 'business_info', $this->business_info])
            ->andFilterWhere(['like', 'marketing_address', $this->marketing_address])
            ->andFilterWhere(['like', 'date_1', $this->date_1]);

        return $dataProvider;
    }
}
