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
use common\models\Product;
use yii\db\Expression;

class RelatedProductWidget extends Widget {

    public $id;

    public function init() {
        parent::init();
        if ($this->id === null) {
            return '';
        }
    }

    public function run() {
        if (!empty($this->id)) {
            $related_vals = explode(',', $this->id);
            $related_product = Product::find()->where(['IN', 'id', $related_vals])->andWhere(['status' => 1])->orderBy(['id' => SORT_DESC])->all();
            return $this->render('related_product', ['related_product' => $related_product]);
        } else {
            return;
        }
    }

}

?>
