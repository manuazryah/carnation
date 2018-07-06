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
use common\models\RecentlyViewed;

class RecentlyViewedWidget extends Widget {

        public $id;

        public function init() {
                parent::init();
                if ($this->id === null) {
                        return '';
                }
        }

        public function run() {
                if (isset(Yii::$app->user->identity->id)) {
                        $recently_viewed = RecentlyViewed::find()->where(['user_id' => $this->id])->orderBy(['id' => SORT_DESC])->offset(1)->all();
                } else if (isset(Yii::$app->session['temp_user_product']) || Yii::$app->session['temp_user_product'] != '') {
                        $recently_viewed = RecentlyViewed::find()->where(['session_id' => Yii::$app->session['temp_user_product']])->orderBy(['id' => SORT_DESC])->offset(1)->all();
                }


                return $this->render('recently-viewed', ['recently_viewed' => $recently_viewed]);
                //return Html::encode($this->message);
        }

}

?>
