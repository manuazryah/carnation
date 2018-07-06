<?php

namespace backend\modules\create_your_own\controllers;

use yii\web\Controller;

/**
 * Default controller for the `create_your_own` module
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
