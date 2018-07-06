<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "scent".
 *
 * @property integer $id
 * @property string $charecter_id
 * @property string $scent
 * @property string $price
 * @property string $img
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Scent extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'scent';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['scent', 'price'], 'required'],
            [['img'], 'required', 'on' => 'create'],
            [['price'], 'number'],
            [['status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU', 'charecter_id'], 'safe'],
            [['scent'], 'string', 'max' => 100],
            [['img'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'charecter_id' => 'Charecter',
            'scent' => 'Scent',
            'price' => 'Price',
            'img' => 'Img',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

    public static function getCharacter($id) {

        $characters = explode(',', $id);
        $result = '';
        $i = 0;
        if (!empty($characters)) {
            foreach ($characters as $val) {

                if ($i != 0) {
                    $result .= ',';
                }
                $character_name = Characters::findOne($val);
                $result .= $character_name->name;
                $i++;
            }
        }

        return $result;
    }

}
