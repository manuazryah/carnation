<?php

namespace backend\modules\create_your_own\controllers;

use Yii;
use common\models\Characters;
use common\models\CharactersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CharactersController implements the CRUD actions for Characters model.
 */
class CharactersController extends Controller {

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
     * Lists all Characters models.
     * @return mixed
     */
    public function actionIndex($id = NULL) {
        if (!empty($id)) {
            $model = $this->findModel($id);
        } else {
            $model = new Characters();
            $model->setScenario('create');
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $this->SetExtension($model) && $model->validate() && $model->save() && $this->upload($model)) {
            if (!empty($id)) {
                Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
            } else {
                Yii::$app->getSession()->setFlash('success', "Create Successfully");
            }
            return $this->redirect(['index']);
        }
        $searchModel = new CharactersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 5;

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    /*
     * This function get model and set image extensions
     * return model
     */

    public function SetExtension($model) {
        $model->img = UploadedFile::getInstance($model, 'img');
        if (isset($model->img)) {
            $model->img = $model->img->extension;
        } else {
            $update = Characters::findOne($model->id);
            $model->img = $update->img;
        }
        return TRUE;
    }

    /**
     * Upload gender image based on id.
     * @return mixed
     */
    public function Upload($model) {
        $model->img = UploadedFile::getInstance($model, 'img');
        if (isset($model->img)) {
            if ($model->img->saveAs(Yii::$app->basePath . '/../uploads/create_your_own/characters/' . $model->id . '.' . $model->img->extension)) {
                if ($model->isNewRecord) {
                    $update = Characters::findOne($model->id);
                    $update->img = $model->img->extension;
                    $update->update();
                } else {
                    $model->img = $model->img->extension;
                    $model->save();
                }
                return true;
            } else {
                return false;
            }
        } else {
            if (!$model->isNewRecord) {
                $update = Characters::findOne($model->id);
                $model->img = $update->img;
                $model->save();
            }
            return true;
        }
    }

    /**
     * Displays a single Characters model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Characters model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Characters();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Characters model.
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
     * Deletes an existing Characters model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Characters model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Characters the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Characters::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
