<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "admin_post".
 *
 * @property integer $id
 * @property string $post_name
 * @property string $admin
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property integer $status
 */
class AdminPost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_name', 'admin','status'], 'required'],
            [['CB', 'UB', 'status'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['post_name', 'admin'], 'string', 'max' => 255],
            [['post_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_name' => 'Post Name',
            'admin' => 'Admin',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'status' => 'Status',
        ];
    }
}
