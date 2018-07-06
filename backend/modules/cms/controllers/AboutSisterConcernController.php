<?php

namespace backend\modules\cms\controllers;

use Yii;
use common\models\AboutSisterConcern;
use common\models\AboutSisterConcernSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * AboutSisterConcernController implements the CRUD actions for AboutSisterConcern model.
 */
class AboutSisterConcernController extends Controller {

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
     * Lists all AboutSisterConcern models.
     * @return mixed
     */
    public function actionIndex($id = null) {
        if (!empty($id)) {
            $model = $this->findModel($id);
            $message = 'Data Updated Successfully';
            $image_ = $model->image;
        } else {
            $model = new AboutSisterConcern();
            $message = 'Data Added Successfully';
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $this->SaveExtension($model, $image_)) {
            if ($model->validate() && $model->save() && $this->SaveImage($model)) {
                Yii::$app->getSession()->setFlash('success', "Updated Successfully");
                return $this->redirect(['index']);
            }
        }
        $searchModel = new AboutSisterConcernSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    function SaveExtension($model, $image_ = null) {
        $image = UploadedFile::getInstance($model, 'image');
        if (!empty($image))
            $model->image = $image->extension;
        else
            $model->image = $image_;
        return $model;
    }

    function SaveImage($model) {
        $image = UploadedFile::getInstance($model, 'image');

        if (!empty($image)) {
            $path = Yii::$app->basePath . '/../uploads/cms/about_sister_concern/' . $model->id;
            $size = [
                ['width' => 100, 'height' => 100, 'name' => 'small'],
            ];
            Yii::$app->UploadFile->UploadFile($model, $image, $path, $size);
        }

        return TRUE;
    }

    /**
     * Displays a single AboutSisterConcern model.
     * @param integer $id
     * @return mixed
     */
//    public function actionView($id) {
//        return $this->render('view', [
//                    'model' => $this->findModel($id),
//        ]);
//    }

    /**
     * Creates a new AboutSisterConcern model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate() {
//        $model = new AboutSisterConcern();
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
     * Updates an existing AboutSisterConcern model.
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
     * Deletes an existing AboutSisterConcern model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionDelete($id) {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    public function actionDel($id) {
        $model = $this->findModel($id);
        $path = Yii::$app->basePath . '/../uploads/cms/about_sister_concern/' . $model->id;
        if (file_exists($path))
            $this->recursiveRemoveDirectory($path);
        if ($model->delete()) {
            Yii::$app->getSession()->setFlash('success', 'Deleted Successfully');
        } else {
            Yii::$app->getSession()->setFlash('error', "Can't Delete");
        }

        return $this->redirect(['index']);
    }

    function recursiveRemoveDirectory($directory) {
        foreach (glob("{$directory}/*") as $file) {
            if (is_dir($file)) {
                recursiveRemoveDirectory($file);
            } else {
                unlink($file);
            }
        }
        FileHelper::removeDirectory($directory);
    }

    /**
     * Finds the AboutSisterConcern model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AboutSisterConcern the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AboutSisterConcern::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
