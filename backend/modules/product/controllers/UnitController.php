<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\Unit;
use common\models\UnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UnitController implements the CRUD actions for Unit model.
 */
class UnitController extends Controller {

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
                        //    'delete' => ['POST'],
                        ],
                    ],
                ];
        }

        /**
         * Lists all Unit models.
         * @return mixed
         */
        public function actionIndex($id = NULL) {
                if (!empty($id)) {
                        $model = $this->findModel($id);
                } else {
                        $model = new Unit();
                }
                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
                        if (!empty($id)) {
                                Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
                        } else {
                                Yii::$app->getSession()->setFlash('success', 'Created Successfully');
                        }
                        return $this->redirect(['index']);
                }
                $searchModel = new UnitSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'model' => $model,
                ]);
        }

        /**
         * Displays a single Unit model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new Unit model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new Unit();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing Unit model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing Unit model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
//    public function actionDel($id) {
//        if ($this->findModel($id)->delete()) {
//            Yii::$app->getSession()->setFlash('success', 'succuessfully deleted');
//        } else {
//            Yii::$app->getSession()->setFlash('error', "Can't delete the Item");
//        }
//        return $this->redirect(['index']);
//    }
//
        public function actionDelete($id) {
                $units = \common\models\Product::find()->where(['stock_unit' => $id])->orWhere(['size_unit' => $id])->exists();
                if ($units != 1) {
                        $this->findModel($id)->delete();
                        Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
                } else {
                        Yii::$app->getSession()->setFlash('error', '0ops! Cannot delete this !');
                }
                return $this->redirect(['index']);
        }

        /**
         * Finds the Unit model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Unit the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Unit::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        /*         * *********** */

        public function actionAjaxaddunit() {
                if (yii::$app->request->isAjax) {
                        $unit = Yii::$app->request->post()['unit'];
                        $model = new Unit();
                        $model->unit_name = $unit;
                        $model->status = '1';
                        if (Yii::$app->SetValues->Attributes($model)) {
                                if ($model->save()) {
                                        echo json_encode(array("con" => "1", 'id' => $model->id, 'unit' => $unit)); //Success
                                        exit;
//            array('id' => $model->id, 'category' => $category);
                                } else {
                                        var_dump($model->getErrors());
//            echo '0';
                                        exit;
                                }
                        }
                }
        }

}
