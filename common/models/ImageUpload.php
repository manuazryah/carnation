<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "image_upload".
 *
 * @property integer $id
 * @property string $imagefile
 */
class ImageUpload extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'image_upload';
    }

    /**
     * @inheritdoc
     */public $imagefile;

    public function rules() {
        return [
//            [['imagefile'], 'file',  'extensions' => 'png, jpg', 'maxFiles' => 3],
        ];
    }

    public function upload($file, $product_id) {
//        echo $product_id;
//        exit;
        if (\yii::$app->basePath . '/../uploads') {
            chmod(\yii::$app->basePath . '/../uploads', 0777);
            
            if (!is_dir(\yii::$app->basePath . '/../uploads/test/' . $product_id)) {
                mkdir(\yii::$app->basePath . '/../uploads/test/' . $product_id);
                chmod(\yii::$app->basePath . '/../uploads/test/' . $product_id, 0777);
            }
            if (!is_dir(\yii::$app->basePath . '/../uploads/test/' . $product_id . '/profile/')) {
                mkdir(\yii::$app->basePath . '/../uploads/test/' . $product_id . '/profile/');
                chmod(\yii::$app->basePath . '/../uploads/test/' . $product_id . '/profile/', 0777);
            }
            
            if ($file->saveAs(\yii::$app->basePath . '/../uploads/test/' . $product_id . '/profile/small.' . $file->extension))
                chmod(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/profile/small.' . $file->extension, 0777);
           
//            if ($file->saveAs(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/profile/medium.' . $file->extension))
//                chmod(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/profile/medium.' . $file->extension, 0777);
//            Image::thumbnail(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/profile/medium.' . $file->extension, 500, 300)
//                    ->resize(new Box(300, 150))
//                    ->save(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/profile/medium.' . $file->extension, ['quality' => 70]);
//            
//            if ($file->saveAs(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/profile/big.' . $file->extension))
//                chmod(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/profile/big.' . $file->extension, 0777);
//            Image::thumbnail(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/profile/big.' . $file->extension, 500, 300)
//                    ->resize(new Box(500, 300))
//                    ->save(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/profile/big.' . $file->extension, ['quality' => 70]);
            return true;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'imagefile' => 'Imagefile',
        ];
    }

}
