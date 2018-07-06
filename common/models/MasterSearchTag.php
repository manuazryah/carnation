<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "master_search_tag".
 *
 * @property integer $id
 * @property string $tag_name
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property integer $status
 */
class MasterSearchTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_search_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_name','status'], 'required'],
            [['CB', 'UB', 'status'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['tag_name'], 'string', 'max' => 255],
            [['tag_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_name' => 'Tag Name',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'status' => 'Status',
        ];
    }
}
