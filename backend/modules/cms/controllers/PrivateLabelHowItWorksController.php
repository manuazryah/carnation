<?php

namespace backend\modules\cms\controllers;

use Yii;
use common\models\PrivateLabelHowItWorks;
use common\models\PrivateLabelHowItWorksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PrivateLabelHowItWorksController implements the CRUD actions for PrivateLabelHowItWorks model.
 */
class PrivateLabelHowItWorksController extends Controller {

    /**
     * @inheritdoc
     */
    public function beforeAction($action) {
        if (!parent::beforeAction($action)) {
            return false;
        }
        if (Yii::$app->user->isGuest) {
            $this->redirect(['/site/index']);
            return false;
        }
        return true;
    }

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PrivateLabelHowItWorks models.
     * @return mixed
     */
    public function actionIndex($id = null) {
        if (!empty($id)) {
            $model = $this->findModel($id);
            $message = 'Data Updated Successfully';
        } else {
            $model = $this->findModel(4);
            $message = 'Data Updated Successfully';
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate()) {
            if ($model->save()) {
                Yii::$app->getSession()->setFlash('success', $message);
                return $this->redirect(['index']);
            }
        }
        $searchModel = new PrivateLabelHowItWorksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PrivateLabelHowItWorks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDel($id) {
        $model = $this->findModel($id);
        if ($model->delete()) {
            Yii::$app->getSession()->setFlash('success', 'Deleted Successfully');
        } else {
            Yii::$app->getSession()->setFlash('error', "Can't Delete");
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the PrivateLabelHowItWorks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PrivateLabelHowItWorks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = PrivateLabelHowItWorks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
