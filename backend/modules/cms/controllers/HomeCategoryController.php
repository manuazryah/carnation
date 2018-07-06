<?php

namespace backend\modules\cms\controllers;

use Yii;
use common\models\HomeCategory;
use common\models\HomeCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

/**
 * HomeCategoryController implements the CRUD actions for HomeCategory model.
 */
class HomeCategoryController extends Controller {

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
     * Lists all HomeCategory models.
     * @return mixed
     */
//    public function actionIndex() {
//        $searchModel = new HomeCategorySearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//                    'searchModel' => $searchModel,
//                    'dataProvider' => $dataProvider,
//        ]);
//    }

    /**
     * Displays a single HomeCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HomeCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate() {
//        $model = new HomeCategory();
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
     * Updates an existing HomeCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->image = $model->image;
        $model->image2 = $model->image2;
        $model->image3 = $model->image3;
        $model->image4 = $model->image4;
        if ($model->load(Yii::$app->request->post())) {
            $image1 = UploadedFile::getInstances($model, 'image');
            $image2 = UploadedFile::getInstances($model, 'image2');
            $image3 = UploadedFile::getInstances($model, 'image3');
            $image4 = UploadedFile::getInstances($model, 'image4');
            if ($image1)
            $model->image = $image1[0]->extension;
            if ($image2)
            $model->image2 = $image2[0]->extension;
            if ($image3)
            $model->image3 = $image3[0]->extension;
            if ($image4)
            $model->image4 = $image4[0]->extension;
            if ($model->save()) {
                if ($image1) {
                    if ($this->upload($model, $image1[0], 'image1')) {
                        $w1 = 750;
                        $w2 = 820;
                        $w3 = 100;
                        $w4 = 110;
                        $model->upload($image1[0], $model, 'image1', $w1, $w2, $w3, $w4);
                    }
                }
                if ($image2) {
                    if ($this->upload($model, $image2[0], 'image2')) {
                        $w1 = 500;
                        $w2 = 550;
                        $w3 = 100;
                        $w4 = 110;
                        $model->upload($image2[0], $model, 'image2', $w1, $w2, $w3, $w4);
                    }
                }
                if ($image3) {
                    if ($this->upload($model, $image3[0], 'image3')) {
                        $w1 = 500;
                        $w2 = 550;
                        $w3 = 100;
                        $w4 = 110;
                        $model->upload($image3[0], $model, 'image3', $w1, $w2, $w3, $w4);
                    }
                }
                if ($image4) {
                    if ($this->upload($model, $image4[0], 'image4')) {
                        $w1 = 750;
                        $w2 = 388;
                        $w3 = 100;
                        $w4 = 50;
                        $model->upload($image4[0], $model, 'image4', $w1, $w2, $w3, $w4);
                    }
                }
            }
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function Upload($model, $file, $image_name) {
        if (!is_dir(\Yii::$app->basePath . '/../uploads/cms/home-category/')) {
            mkdir(\Yii::$app->basePath . '/../uploads/cms/home-category/');
            chmod(\Yii::$app->basePath . '/../uploads/cms/home-category/', 0777);
        }
        $file->saveAs(Yii::$app->basePath . '/../uploads/cms/home-category/' . $image_name . '.' . $file->extension);
        return TRUE;
    }

    /**
     * Deletes an existing HomeCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionDelete($id) {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the HomeCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HomeCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = HomeCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
