<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer_reviews".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property string $tittle
 * @property string $description
 * @property string $review_date
 */
class CustomerReviews extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'customer_reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'product_id'], 'integer'],
            [['description'], 'string'],
            [['review_date'], 'safe'],
            [['tittle'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'product_id' => 'Product',
            'tittle' => 'Tittle',
            'description' => 'Description',
            'review_date' => 'Review Date',
        ];
    }

}
