<?php

namespace backend\modules\cms\controllers;

use Yii;
use common\models\StoreLocator;
use common\models\StoreLocatorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * StoreLocatorController implements the CRUD actions for StoreLocator model.
 */
class StoreLocatorController extends Controller {

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
     * Lists all StoreLocator models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new StoreLocatorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StoreLocator model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StoreLocator model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new StoreLocator();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $this->SetExtension($model, $model->id) && $model->save() && $this->SaveUpload($model)) {
            Yii::$app->getSession()->setFlash('success', "Create Successfully");
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StoreLocator model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $this->SetExtension($model, $model->id) && $model->save() && $this->SaveUpload($model)) {
             Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
              return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StoreLocator model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function SetExtension($model, $id) {
        $image = UploadedFile::getInstance($model, 'image');
        if (!empty($id)) {
            $update = StoreLocator::findOne($id);
            if (!empty($image)) {
                $model->image = $image->extension;
            } else {
                $model->image = $update->image;
            }
        } else {
            $model->image = $image->extension;
        }

        return TRUE;
    }

    public function SaveUpload($model) {
        $image = UploadedFile::getInstance($model, 'image');
        $path = Yii::$app->basePath . '/../uploads/cms/store-locator/' . $model->id;
        if (!file_exists($path)) {
            FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        }
        $size = [
            ['width' => 850, 'height' => 610, 'name' => 'medium'],
            ['width' => 90, 'height' => 65, 'name' => 'thumb'],
        ];

        if (!empty($image)) {
            Yii::$app->UploadFile->UploadFile($model, $image, $path, $size);
        }
        return TRUE;
    }

    /**
     * Finds the StoreLocator model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoreLocator the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = StoreLocator::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
