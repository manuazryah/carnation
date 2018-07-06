<?php

namespace backend\modules\promotions\controllers;

use yii\web\Controller;

/**
 * Default controller for the `promotions` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
