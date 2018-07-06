<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SetValues
 *
 * @author user
 */

namespace common\components;

use Yii;
use yii\base\Component;

class SetValues extends Component {

    public function Attributes($model) {
        if (isset($model) && !Yii::$app->user->isGuest) {
            if ($model->isNewRecord) {
                $model->UB = Yii::$app->user->identity->id;
                $model->CB = Yii::$app->user->identity->id;
                $model->DOC = date('Y-m-d');
            } else {
                $model->UB = Yii::$app->user->identity->id;
            }

            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * Repeated followups Dates listing
     */

    public function Dates() {
        $dates = [];
        for ($i = 1; $i <= 31; $i++) {
            $dates[$i] = $i;
        }
        return $dates;
    }

    /*
     * Repeated followups Dates listing
     */

    public function Months() {
//        $months = array(1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $months = array(1 => 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec');
        return $months;
    }

    /*
     * Repeated followups Dates listing
     */

    public function Years() {
        $years = range(date("Y"), 1910);
        return $years;
    }

}
