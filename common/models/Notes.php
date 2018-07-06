<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notes".
 *
 * @property integer $id
 * @property string $scent_id
 * @property string $notes
 * @property string $price
 * @property string $main_img
 * @property string $description
 * @property string $sub_img
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Notes extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'notes';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['scent_id', 'notes', 'price'], 'required'],
            [['main_img', 'sub_img'], 'required', 'on' => 'create'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['status', 'CB', 'UB'], 'integer'],
            [['scent_id', 'DOC', 'DOU', 'main_img', 'sub_img'], 'safe'],
            [['notes'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'scent_id' => 'Scent',
            'notes' => 'Notes',
            'price' => 'Price',
            'main_img' => 'Main Img',
            'description' => 'Description',
            'sub_img' => 'Sub Img',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

    public static function getScent($id) {

        $scents = explode(',', $id);
        $result = '';
        $i = 0;
        if (!empty($scents)) {
            foreach ($scents as $val) {

                if ($i != 0) {
                    $result .= ',';
                }
                $scents_name = Scent::findOne($val);
                $result .= $scents_name->scent;
                $i++;
            }
        }

        return $result;
    }

}
