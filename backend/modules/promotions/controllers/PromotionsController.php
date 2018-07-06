<?php

namespace backend\modules\promotions\controllers;

use Yii;
use common\models\Promotions;
use common\models\PromotionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PromotionsController implements the CRUD actions for Promotions model.
 */
class PromotionsController extends Controller {

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
         * Lists all Promotions models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new PromotionsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single Promotions model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new Promotions model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new Promotions();
                $model->setScenario('create');

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {

                        if (!empty($model->product_id)) {
                                $model->product_id = implode(',', $model->product_id);
                        }
                        if (!empty($model->user_id)) {
                                $model->user_id = implode(',', $model->user_id);
                        }
                        if (!empty($model->brand)) {
                                $model->brand = implode(',', $model->brand);
                        }
                        $model->starting_date = date('Y-m-d', strtotime($model->starting_date));
                        $model->expiry_date = date('Y-m-d', strtotime($model->expiry_date));
                        if ($model->save())
                                return $this->redirect('index');
                }
                return $this->render('create', [
                            'model' => $model,
                ]);
        }

        /**
         * Updates an existing Promotions model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);
                $model->setScenario('create');

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {

                        if (!empty($model->product_id)) {
                                $model->product_id = implode(',', $model->product_id);
                        }

                        if (!empty($model->user_id)) {
                                $model->user_id = implode(',', $model->user_id);
                        }

                        if (!empty($model->brand)) {
                                $model->brand = implode(',', $model->brand);
                        }

                        $model->starting_date = date('Y-m-d', strtotime($model->starting_date));
                        $model->expiry_date = date('Y-m-d', strtotime($model->expiry_date));
                        if ($model->save())
                                return $this->redirect('index');
                }
                return $this->render('update', [
                            'model' => $model,
                ]);
        }

        /**
         * Deletes an existing Promotions model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the Promotions model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Promotions the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Promotions::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
