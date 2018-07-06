<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "about_our_strategic".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class AboutOurStrategic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'about_our_strategic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'CB', 'UB', 'DOC'], 'required'],
            [['content'], 'string'],
            [['CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['title'], 'string', 'max' => 270],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }
}
