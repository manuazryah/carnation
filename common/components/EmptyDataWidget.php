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

//use common\models\RecentlyViewed;

class EmptyDataWidget extends Widget {

    public $path;
    public $msg;

    public function init() {
        parent::init();
        if (!isset(Yii::$app->user->identity->id)) {
            return '';
        }
    }

    public function run() {
        return $this->render('empty-data', ['path' => $this->path, 'msg' => $this->msg]);
    }

}

?>
