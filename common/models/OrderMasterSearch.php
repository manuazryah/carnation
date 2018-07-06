<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OrderMaster;

/**
 * OrderMasterSearch represents the model behind the search form about `common\models\OrderMaster`.
 */
class OrderMasterSearch extends OrderMaster {

        public $createdFrom;
        public $createdTo;
        public $created_at_range;

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['id', 'user_id', 'ship_address_id', 'bill_address_id', 'currency_id', 'payment_mode', 'admin_comment', 'payment_status', 'admin_status', 'shipping_status', 'status'], 'integer'],
                        [['order_id', 'order_date', 'user_comment', 'doc', 'created_at_range'], 'safe'],
                        [['total_amount'], 'number'],
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
                if (!isset($params["OrderMasterSearch"]["createdFrom"])) {
                        $params["OrderMasterSearch"]["createdFrom"] = '';
                } else {
                        $params["OrderMasterSearch"]["createdFrom"] = $params["OrderMasterSearch"]["createdFrom"] . ' 00:00:00';
                }
                if (!isset($params["OrderMasterSearch"]["createdTo"])) {
                        $params["OrderMasterSearch"]["createdTo"] = '';
                } else {
                        $params["OrderMasterSearch"]["createdTo"] = $params["OrderMasterSearch"]["createdTo"] . ' 60:60:60';
                }
                $query = OrderMaster::find()->orderBy(['id' => SORT_DESC]);

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
                    'user_id' => $this->user_id,
                    'total_amount' => $this->total_amount,
                    'net_amount' => $this->net_amount,
                    'order_date' => $this->order_date,
                    'ship_address_id' => $this->ship_address_id,
                    'bill_address_id' => $this->bill_address_id,
                    'currency_id' => $this->currency_id,
                    'payment_mode' => $this->payment_mode,
                    'admin_comment' => $this->admin_comment,
                    'payment_status' => $this->payment_status,
                    'admin_status' => $this->admin_status,
                    'doc' => $this->doc,
                    'shipping_status' => $this->shipping_status,
                    'status' => $this->status,
                ]);

                $query->andFilterWhere(['like', 'order_id', $this->order_id])
                        ->andFilterWhere(['like', 'user_comment', $this->user_comment])
                        ->andFilterWhere(['>=', 'order_date', $params["OrderMasterSearch"]["createdFrom"]])
                        ->andFilterWhere(['<=', 'order_date', $params["OrderMasterSearch"]["createdTo"]]);
                ;

                return $dataProvider;
        }

        public function search1($params) {

                if (!isset($params["OrderMasterSearch"]["createdFrom"])) {
                        $params["OrderMasterSearch"]["createdFrom"] = '';
                } else {
                        $params["OrderMasterSearch"]["createdFrom"] = $params["OrderMasterSearch"]["createdFrom"] . ' 00:00:00';
                }
                if (!isset($params["OrderMasterSearch"]["createdTo"])) {
                        $params["OrderMasterSearch"]["createdTo"] = '';
                } else {
                        $params["OrderMasterSearch"]["createdTo"] = $params["OrderMasterSearch"]["createdTo"] . ' 60:60:60';
                }
                $query = OrderMaster::find()->where(['status' => 4])->andWhere(['<>', 'status', 5])->orderBy(['id' => SORT_DESC]);

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

//                if (!empty($this->created_at_range) && strpos($this->created_at_range, '-') !== false) {
//                        list($start_date, $end_date) = explode(' - ', $this->created_at_range);
//
//                        $query->andFilterWhere(['between', 'order_date', ($start_date . ' 00:00:00'), ($end_date . ' 23:59:59')]);
//                }
                // grid filtering conditions
                $query->andFilterWhere([
                    'id' => $this->id,
                    'user_id' => $this->user_id,
                    'total_amount' => $this->total_amount,
                    'net_amount' => $this->net_amount,
                    //           'order_date' => $this->order_date,
                    'ship_address_id' => $this->ship_address_id,
                    'bill_address_id' => $this->bill_address_id,
                    'currency_id' => $this->currency_id,
                    'payment_mode' => $this->payment_mode,
                    'admin_comment' => $this->admin_comment,
                    'payment_status' => $this->payment_status,
                    'admin_status' => $this->admin_status,
                    'doc' => $this->doc,
                    'shipping_status' => $this->shipping_status,
                    'status' => $this->status,
                ]);

                $query->andFilterWhere(['like', 'order_id', $this->order_id])
                        ->andFilterWhere(['like', 'user_comment', $this->user_comment])
//                ->andFilterWhere(['>=', 'order_date', $params["OrderMasterSearch"]["createdFrom"]])
//                ->andFilterWhere(['<=', 'order_date', $params["OrderMasterSearch"]["createdTo"]]);
                ;

                return $dataProvider;
        }
        public function searchcancel($params) {

                
                $query = OrderMaster::find()->where(['status' => 5])->orderBy(['id' => SORT_DESC]);

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

//                if (!empty($this->created_at_range) && strpos($this->created_at_range, '-') !== false) {
//                        list($start_date, $end_date) = explode(' - ', $this->created_at_range);
//
//                        $query->andFilterWhere(['between', 'order_date', ($start_date . ' 00:00:00'), ($end_date . ' 23:59:59')]);
//                }
                // grid filtering conditions
                $query->andFilterWhere([
                    'id' => $this->id,
                    'user_id' => $this->user_id,
                    'total_amount' => $this->total_amount,
                    'net_amount' => $this->net_amount,
                    //           'order_date' => $this->order_date,
                    'ship_address_id' => $this->ship_address_id,
                    'bill_address_id' => $this->bill_address_id,
                    'currency_id' => $this->currency_id,
                    'payment_mode' => $this->payment_mode,
                    'admin_comment' => $this->admin_comment,
                    'payment_status' => $this->payment_status,
                    'admin_status' => $this->admin_status,
                    'doc' => $this->doc,
                    'shipping_status' => $this->shipping_status,
                    'status' => $this->status,
                ]);

                $query->andFilterWhere(['like', 'order_id', $this->order_id])
                        ->andFilterWhere(['like', 'user_comment', $this->user_comment])
//                ->andFilterWhere(['>=', 'order_date', $params["OrderMasterSearch"]["createdFrom"]])
//                ->andFilterWhere(['<=', 'order_date', $params["OrderMasterSearch"]["createdTo"]]);
                ;

                return $dataProvider;
        }

}
