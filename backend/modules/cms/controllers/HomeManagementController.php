<?php

namespace backend\modules\cms\controllers;

use Yii;
use common\models\HomeManagement;
use common\models\HomeManagementSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * HomeManagementController implements the CRUD actions for HomeManagement model.
 */
class HomeManagementController extends Controller {

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
         * Lists all HomeManagement models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new HomeManagementSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single HomeManagement model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new HomeManagement model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new HomeManagement();

                if ($model->load(Yii::$app->request->post())) {
                        if (isset($model->products))
                                $model->products = implode(',', $model->products);
                        $model->save();
                        return $this->redirect(['view', 'id' => $model->id]);
                }
                return $this->render('create', [
                            'model' => $model,
                ]);
        }

        /**
         * Updates an existing HomeManagement model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);
                $image_ = $model->image;
                if ($model->load(Yii::$app->request->post())) {
                        if (isset($model->products))
                                $model->products = implode(',', $model->products);
                        $image = UploadedFile::getInstance($model, 'image');
                        if (!empty($image)) {
                                $model->image = $image->extension;
                                $this->SaveUpload($image, $model);
                        } else {
                                $model->image = $image_;
                        }
                        $model->save();
                        Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
                        return $this->redirect(['index']);
                }
                return $this->render('update', [
                            'model' => $model,
                ]);
        }

        public function SaveUpload($image, $model) {
                $path = Yii::$app->basePath . '/../uploads/cms/home-management';
                $size = [
                        ['width' => 300, 'height' => 120, 'name' => 'small'],
                ];

                if (!empty($image)) {
                        Yii::$app->UploadFile->UploadFile($model, $image, $path, $size);
                }
                return TRUE;
        }

        /**
         * Deletes an existing HomeManagement model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the HomeManagement model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return HomeManagement the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = HomeManagement::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
