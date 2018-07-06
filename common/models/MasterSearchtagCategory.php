<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "master_searchtag_category".
 *
 * @property int $id
 * @property string $category
 * @property string $search_tags
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 * @property int $status
 */
class MasterSearchtagCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_searchtag_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'search_tags'], 'required'],
            [['CB', 'UB', 'status'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['category'], 'string', 'max' => 200],
//            [['search_tags'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'search_tags' => 'Search Tags',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'status' => 'Status',
        ];
    }
}
