<?php

namespace common\models;

use Yii;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "home_category".
 *
 * @property int $id
 * @property string $title1
 * @property string $url1
 * @property string $image
 * @property string $title2
 * @property string $url2
 * @property string $image2
 * @property string $title3
 * @property string $url3
 * @property string $image3
 * @property string $title4
 * @property string $url4
 * @property string $image4
 * @property int $UB
 * @property string $DOU
 */
class HomeCategory extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'home_category';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title1', 'url1', 'title2', 'url2', 'title3', 'url3', 'title4', 'url4'], 'required'],
            [['UB'], 'integer'],
            [['DOU'], 'safe'],
            [['title1', 'title2', 'title3', 'title4'], 'string', 'max' => 200],
            [['url1', 'url2', 'url3', 'url4'], 'string', 'max' => 250],
//            [['image', 'image2', 'image3', 'image4'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title1' => 'Title1',
            'url1' => 'Url1',
            'image' => 'Image 1',
            'title2' => 'Title2',
            'url2' => 'Url2',
            'image2' => 'Image2',
            'title3' => 'Title3',
            'url3' => 'Url3',
            'image3' => 'Image3',
            'title4' => 'Title4',
            'url4' => 'Url4',
            'image4' => 'Image4',
            'UB' => 'Ub',
            'DOU' => 'Dou',
        ];
    }

    public function upload($file, $model, $image_name, $w1, $w2, $w3, $w4) {
        if (\yii::$app->basePath . '/../uploads') {
            $path = yii::$app->basePath . '/../uploads/cms/home-category/' . $image_name . '.' .  $file->extension;

            Image::thumbnail($path, $w1, $w2)
                    ->save(\yii::$app->basePath . '/../uploads/cms/home-category/' . $image_name . '.' .  $file->extension, ['quality' => 50]);

            Image::thumbnail($path, $w3, $w4)
                    ->save(\yii::$app->basePath . '/../uploads/cms/home-category/' . $image_name . '_small.' . $file->extension, ['quality' => 50]);

            
//            
            return true;
        }
    }

}
