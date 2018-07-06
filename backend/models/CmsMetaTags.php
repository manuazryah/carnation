<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cms_meta_tags".
 *
 * @property integer $id
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property string $page_title
 */
class CmsMetaTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_meta_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meta_description', 'meta_keyword'], 'string'],
            [['CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['meta_title'], 'string', 'max' => 500],
            [['page_title'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keyword' => 'Meta Keyword',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'page_title' => 'Page Title',
        ];
    }
}
