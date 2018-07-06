<?php

namespace common\models;

use Yii;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $main_category
 * @property integer $category
 * @property integer $subcategory
 * @property string $product_name
 * @property string $canonical_name
 * @property string $item_ean
 * @property string $sku
 * @property string $brand
 * @property string $ean_type
 * @property string $ean_value
 * @property integer $gender_type
 * @property string $price
 * @property string $offer_price
 * @property integer $currency
 * @property integer $stock
 * @property integer $stock_unit
 * @property integer $tax
 * @property integer $free_shipping
 * @property string $product_type
 * @property integer $size
 * @property integer $size_unit
 * @property string $main_description
 * @property string $product_detail
 * @property integer $condition
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property integer $status
 * @property integer $featured_product
 * @property string $profile
 * @property string $sort
 */
class Product extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['main_category', 'category', 'subcategory', 'gender_type', 'currency', 'stock', 'stock_unit', 'free_shipping', 'size', 'size_unit', 'condition', 'CB', 'UB', 'status', 'featured_product','tax'], 'integer'],
            [['main_category','category','product_name', 'canonical_name', 'item_ean', 'brand', 'price', 'currency', 'stock', 'stock_unit', 'product_type', 'product_detail'], 'required'],
//             [['profile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'on' => 'create'],
            [['price', 'offer_price'], 'number'],
            [['main_description', 'product_detail'], 'string'],
            [['DOC', 'DOU'], 'safe'],
            [['product_name', 'canonical_name'], 'string', 'max' => 100],
//            [['item_ean'], 'string', 'max' => 255],
            [['canonical_name'], 'unique'],
            [['item_ean'], 'unique'],
            [['other_image'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 3],
            [['profile'], 'file',  'extensions' => 'png, jpg, jpeg', 'on' => 'create'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'main_category' => 'Main Category',
            'category' => 'Category',
            'subcategory' => 'Subcategory',
            'product_name' => 'Product Name',
            'canonical_name' => 'Canonical Name',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'search_tag' => 'Search Tag',
            'item_ean' => 'SKU',
  //          'sku' => 'SKU',
            'brand' => 'Brand',
            'ean_type' => 'EAN/UPC',
            'ean_value' => 'EAN/UPC value',
            'gender_type' => 'Gender Type',
            'price' => 'Product Price',
            'offer_price' => 'Offer Price',
            'currency' => 'Currency',
            'stock' => 'Stock',
            'stock_unit' => 'Stock Unit',
            'stock_availability' => 'Stock Availability',
            'tax' => 'Tax',
            'free_shipping' => 'Free Shipping',
            'product_type' => 'Fragrance Type',
            'size' => 'Size',
            'size_unit' => 'Size Unit',
            'main_description' => 'Main Description',
            'product_detail' => 'Product Detail',
            'condition' => 'Condition',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'status' => 'Status',
            'profile' => 'Profile Picture',
            'other_image' => 'Other Images',
            'profile_alt' => 'Profile Alt',
            'gallery_alt' => 'Gallery Alt',
            'related_product' => 'Related Products',
            'featured_product' => 'Featured Product',
            'sort' => 'Sort Number',
        ];
    }

   public function upload($file, $model) {
        if (\yii::$app->basePath . '/../uploads') {
            $path = yii::$app->basePath . '/../uploads/product/' . $model->id . '/profile/' . $model->canonical_name . '_big.' . $file->extension;

            Image::thumbnail($path, 200, 232)
                    ->save(\yii::$app->basePath . '/../uploads/product/' . $model->id . '/profile/' . $model->canonical_name . '.' . $file->extension, ['quality' => 50]);

            Image::thumbnail($path, 400, 450)
                    ->save(\yii::$app->basePath . '/../uploads/product/' . $model->id . '/profile/' . $model->canonical_name . '_big.' . $file->extension, ['quality' => 50]);
           
            Image::thumbnail($path, 98, 114)
                    ->save(\yii::$app->basePath . '/../uploads/product/' . $model->id . '/profile/' . $model->canonical_name . '_thumb.' . $file->extension, ['quality' => 50]);
//            
            return true;
        }
    }

    public function uploadMultiple($file, $product_id, $canname, $i) {
        if (\yii::$app->basePath . '/../uploads') {
            chmod(\yii::$app->basePath . '/../uploads', 0777);

            if (!is_dir(\yii::$app->basePath . '/../uploads/product/')) {
                mkdir(\yii::$app->basePath . '/../uploads/product/');
                chmod(\yii::$app->basePath . '/../uploads/product/', 0777);
            }
            if (!is_dir(\yii::$app->basePath . '/../uploads/product/' . $product_id)) {
                mkdir(\yii::$app->basePath . '/../uploads/product/' . $product_id);
                chmod(\yii::$app->basePath . '/../uploads/product/' . $product_id, 0777);
            }
            if (!is_dir(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/gallery')) {
                mkdir(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/gallery');
                chmod(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/gallery', 0777);
            }
            $path = yii::$app->basePath . '/../uploads/product/' . $product_id . '/gallery';
            $main_path = yii::$app->basePath . '/../uploads/product/' . $product_id;
            $name = $this->fileExists($path, $canname, $image_name = $canname, $file->extension, 1);
            if ($file->saveAs($path . '/' . $name)) {
                chmod($path . '/' . $name, 0777);
                if (!is_dir(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/gallery_large/')) {
                    mkdir(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/gallery_large/');
                    chmod(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/gallery_large/', 0777);
                }
                Image::thumbnail($path . '/' . $name, 400, 450)
                        ->save($main_path . '/gallery_large/' . $name, ['quality' => 80]);
                Image::thumbnail($path . '/' . $name, 200, 232)
                        ->save($main_path . '/gallery/' . $name, ['quality' => 80]);
            }
//            if ($file->saveAs(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/' . $file->name . '.' . $file->extension))
//                chmod(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/' . $file->name . '.' . $file->extension, 0777);
//            Image::thumbnail(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/' . $file->name . '.' . $file->extension, 500, 300)
//                    ->resize(new Box(500, 200))
//                    ->save(\yii::$app->basePath . '/../uploads/product/' . $product_id . '/' . $file->name . '.' . $file->extension, ['quality' => 70]);
            return true;
        }
    }

    public function fileExists($path, $canname, $image_name, $extension, $sufix) {
        if (file_exists($path . '/' . $image_name . '.' . $extension)) {
            $image_name = basename($path . '/' . $canname . '_' . $sufix);
            return $this->fileExists($path, $canname, $image_name, $extension, $sufix + 1);
        } else {
            return $image_name . '.' . $extension;
        }
    }
    public static function RecentlyViewed($product) {
        $user_id = '';
        $sessonid = '';
        if (isset(Yii::$app->user->identity->id)) {
            $user_id = Yii::$app->user->identity->id;
            $model = RecentlyViewed::find()->where(['product_id' => $product->id, 'user_id' => $user_id])->one();
        } else {
            if (!isset(Yii::$app->session['temp_user_product']) || Yii::$app->session['temp_user_product'] == '') {
                $milliseconds = round(microtime(true) * 1000);
                Yii::$app->session['temp_user_product'] = $milliseconds;
            }
            $model = RecentlyViewed::find()->where(['product_id' => $product->id, 'session_id' => Yii::$app->session['temp_user_product']])->one();
            $sessonid = Yii::$app->session['temp_user_product'];
        }
        if (empty($model)) {
            $model = new RecentlyViewed();
            $model->user_id = $user_id;
            $model->session_id = $sessonid;
            $model->product_id = $product->id;
            $model->date = date('Y-m-d');
        } else {
            $model->date = date('Y-m-d');
        }
        $model->save();
        return;
    }

}
