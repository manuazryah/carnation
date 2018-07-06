<?php

namespace backend\modules\create_your_own\controllers;

use Yii;
use common\models\Scent;
use common\models\ScentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ScentController implements the CRUD actions for Scent model.
 */
class ScentController extends Controller {

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
     * Lists all Scent models.
     * @return mixed
     */
    public function actionIndex($id = NULL) {
        if (!empty($id)) {
            $model = $this->findModel($id);
        } else {
            $model = new Scent();
            $model->setScenario('create');
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $this->SetExtension($model) && $model->validate() && $this->Character($model, $_POST['Scent']['charecter_id']) && $model->save() && $this->upload($model)) {
            if (!empty($id)) {
                Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
            } else {
                Yii::$app->getSession()->setFlash('success', "Create Successfully");
            }
            return $this->redirect(['index']);
        }
        $searchModel = new ScentSearch();
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
            $update = Scent::findOne($model->id);
            $model->img = $update->img;
        }
        return TRUE;
    }

    /*
     * This function get character from multiple select box and implode it with comma
     * return character as a string
     */

    public function Character($model, $character) {
        if ($model != null && $character != '') {
            $model->charecter_id = implode(",", $character);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Upload gender image based on id.
     * @return mixed
     */
    public function Upload($model) {
        $model->img = UploadedFile::getInstance($model, 'img');
        if (isset($model->img)) {
            if ($model->img->saveAs(Yii::$app->basePath . '/../uploads/create_your_own/scent/' . $model->id . '.' . $model->img->extension)) {
                if ($model->isNewRecord) {
                    $update = Scent::findOne($model->id);
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
                $update = Scent::findOne($model->id);
                $model->img = $update->img;
                $model->save();
            }
            return true;
        }
    }

    /**
     * Displays a single Scent model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Scent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Scent();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Scent model.
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
     * Deletes an existing Scent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Scent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Scent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Scent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
