<?php

namespace backend\modules\user\controllers;

use Yii;
use common\models\CustomerReviews;
use common\models\CustomerReviewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CustomerReviewsController implements the CRUD actions for CustomerReviews model.
 */
class CustomerReviewsController extends Controller {

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


    /**
     * @inheritdoc
     */
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
     * Lists all CustomerReviews models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CustomerReviewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CustomerReviews model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CustomerReviews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new CustomerReviews();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CustomerReviews model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            var_dump($model);
            exit;
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Approve User review
     * @param integer $id
     * @return mixed
     */
    public function actionApprove($id) {
        $model = $this->findModel($id);
        $model->status = 1;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Disable User review.
     * @param integer $id
     * @return mixed
     */
    public function actionDisable($id) {
        $model = $this->findModel($id);
        $model->status = 0;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing CustomerReviews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDel($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CustomerReviews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CustomerReviews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = CustomerReviews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
