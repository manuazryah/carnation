<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\MasterSearchtagCategory;
use common\models\MasterSearchtagCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MasterSearchtagCategoryController implements the CRUD actions for MasterSearchtagCategory model.
 */
class MasterSearchtagCategoryController extends Controller {

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
     * Lists all MasterSearchtagCategory models.
     * @return mixed
     */
    public function actionIndex($id = NULL) {
        if (!empty($id)) {
            $model = $this->findModel($id);
        } else {
            $model = new MasterSearchtagCategory();
        }
//        $tag = Yii::$app->request->post()['Product']['search_tag'];
//                if ($tag) {
//                    $model->search_tag = implode(',', $tag);
//                }
        if ($model->load(Yii::$app->request->post())) {
            $tag = Yii::$app->request->post()['MasterSearchtagCategory']['search_tags'];
            if ($tag) {
                $model->search_tags = implode(',', $tag);
            }
            if (Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
                if (!empty($id)) {
                    Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
                } else {
                    Yii::$app->getSession()->setFlash('success', 'Created Successfully');
                }
                return $this->redirect(['index']);
            }
        }
        $searchModel = new MasterSearchtagCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

//    public function actionIndex() {
//        $searchModel = new MasterSearchtagCategorySearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//                    'searchModel' => $searchModel,
//                    'dataProvider' => $dataProvider,
//        ]);
//    }

    /**
     * Displays a single MasterSearchtagCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MasterSearchtagCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate() {
//        $model = new MasterSearchtagCategory();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('create', [
//                        'model' => $model,
//            ]);
//        }
//    }

    /**
     * Updates an existing MasterSearchtagCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionUpdate($id) {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                        'model' => $model,
//            ]);
//        }
//    }

    /**
     * Deletes an existing MasterSearchtagCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionAjaxsearchtag() {
        if (yii::$app->request->isAjax) {
            $search_tags = array();
            $cat_id = Yii::$app->request->post()['cat_id'];
            $master_searchtag = \common\models\MasterSearchtagCategory::findOne($cat_id)->search_tags;
            $tags = explode(',', $master_searchtag);
            echo json_encode(array("con" => "1", 'id' => $tags)); //Success
            exit;
        }
    }

    /**
     * Finds the MasterSearchtagCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MasterSearchtagCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MasterSearchtagCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
