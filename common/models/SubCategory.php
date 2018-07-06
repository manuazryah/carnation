<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sub_category".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $sub_category
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property integer $status
 *
 * @property Category $category
 */
class SubCategory extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'sub_category';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['main_category', 'category_id', 'sub_category'], 'required'],
            [['main_category', 'category_id', 'CB', 'UB', 'status'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['sub_category'], 'string', 'max' => 200],
            [['sub_category'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'main_category' => 'Main Category',
            'category_id' => 'Category',
            'sub_category' => 'Sub Category',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory() {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

}
