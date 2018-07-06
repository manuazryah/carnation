<?php

namespace backend\controllers;

use Yii;
use common\models\ImageUpload;
use common\models\ImageUploadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * ImageUploadController implements the CRUD actions for ImageUpload model.
 */
class ImageUploadController extends Controller {

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
     * Lists all ImageUpload models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ImageUploadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ImageUpload model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ImageUpload model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ImageUpload();

        if (Yii::$app->request->isPost) {
            $filee = UploadedFile::getInstances($model, 'imagefile');
//            echo '<pre>';            print_r($filee);exit;
//            echo $filee->extension;exit;
            $model->imagefile=$filee[0]->name;
            if ($model->save()) {
                if (isset($filee)) {
                    $this->upload($filee[0]);
//                    $this->upload($model, $filee);
                }
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function Upload($filee) {
//        echo Yii::$app->basePath . '/../uploads/' . $filee->name . '.' . $filee->extension;
//        exit;
        $filee->saveAs(Yii::$app->basePath . '/../uploads/' . $filee->name . '.' . $filee->extension);
    }

    /**
     * Updates an existing ImageUpload model.
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
     * Deletes an existing ImageUpload model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ImageUpload model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ImageUpload the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ImageUpload::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
