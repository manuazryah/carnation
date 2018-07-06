<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form about `common\models\Product`.
 */
class ProductSearch extends Product {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'main_category', 'category', 'subcategory', 'gender_type', 'currency', 'stock', 'stock_unit', 'tax', 'free_shipping', 'size', 'size_unit', 'condition', 'CB', 'UB', 'status', 'featured_product'], 'integer'],
            [['product_name', 'canonical_name', 'item_ean', 'brand', 'product_type', 'main_description', 'product_detail', 'DOC', 'DOU', 'profile', 'stock_availability', 'related_product', 'sort'], 'safe'],
            [['price', 'offer_price'], 'number'],
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
        $query = Product::find()->orderBy(['DOU' => SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
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
            'category' => $this->category,
            'subcategory' => $this->subcategory,
            'gender_type' => $this->gender_type,
            'price' => $this->price,
            'offer_price' => $this->offer_price,
            'currency' => $this->currency,
            'stock' => $this->stock,
            'stock_unit' => $this->stock_unit,
            'stock_availability' => $this->stock_availability,
            'tax' => $this->tax,
            'free_shipping' => $this->free_shipping,
            'size' => $this->size,
            'size_unit' => $this->size_unit,
            'condition' => $this->condition,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
            'status' => $this->status,
            'profile' => $this->profile,
            'profile_alt' => $this->profile_alt,
            'gallery_alt' => $this->gallery_alt,
            'related_product' => $this->related_product,
            'featured_product' => $this->featured_product,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'product_name', $this->product_name])
                ->andFilterWhere(['like', 'canonical_name', $this->canonical_name])
                ->andFilterWhere(['like', 'meta_title', $this->meta_title])
                ->andFilterWhere(['like', 'meta_description', $this->meta_description])
                ->andFilterWhere(['like', 'meta_keywords', $this->meta_keywords])
                ->andFilterWhere(['like', 'search_tag', $this->search_tag])
                ->andFilterWhere(['like', 'item_ean', $this->item_ean])
                ->andFilterWhere(['like', 'sku', $this->sku])
                ->andFilterWhere(['like', 'brand', $this->brand])
                ->andFilterWhere(['like', 'product_type', $this->product_type])
                ->andFilterWhere(['like', 'main_description', $this->main_description])
                ->andFilterWhere(['like', 'product_detail', $this->product_detail]);

        return $dataProvider;
    }

}
