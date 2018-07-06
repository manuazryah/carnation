<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppointmentWidget
 *
 * @author
 * JIthin Wails
 */

namespace common\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use common\models\Brand;
use common\models\Fregrance;
use common\models\Category;
use common\models\Product;

class SidemenuWidget extends Widget {

    public $id;
    public $first;
    public $div_id;
    public $submenu;
    public $brand_list;

    public function init() {
        parent::init();
        if ($this->id === null) {
            return '';
        }
    }

    public function run() {
        $brand_list = $this->brand_list;
//        $submenu = $this->submenu;
//        $category = Category::find()->where(['status' => 1, 'category_code' => $submenu])->one();
//        $products = Product::find()->select('brand')->where(['category' => $category->id])->all();
//        foreach ($products as $product) {
//            $product_[] = $product->brand;
//        }
//        $brand_list = Brand::find()->where(['status' => 1])->andWhere(['IN', 'id', $product_])->groupBy(['brand'])->all();
        $fragrances = Fregrance::find()->where(['status' => 1])->all();
        return $this->render('side-menu', ['brand_list' => $brand_list, 'fragrances' => $fragrances]);
    }

}

?>
