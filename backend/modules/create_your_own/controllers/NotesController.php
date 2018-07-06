<?php

namespace backend\modules\create_your_own\controllers;

use Yii;
use common\models\Notes;
use common\models\NotesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * NotesController implements the CRUD actions for Notes model.
 */
class NotesController extends Controller {

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
     * Lists all Notes models.
     * @return mixed
     */
    public function actionIndex($id = NULL) {
        if (!empty($id)) {
            $model = $this->findModel($id);
        } else {
            $model = new Notes();
            $model->setScenario('create');
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $this->SetExtension($model) && $model->validate() && $this->Scents($model, $_POST['Notes']['scent_id']) && $model->save() && $this->upload($model, 'main_img') && $this->upload($model, 'sub_img')) {
            if (!empty($id)) {
                Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
            } else {
                Yii::$app->getSession()->setFlash('success', "Create Successfully");
            }
            return $this->redirect(['index']);
        }
        $searchModel = new NotesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 5;

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    /**
     * Displays a single Notes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Notes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Notes();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $this->Scents($model, $_POST['Notes']['scent_id']) && $model->save() && $this->upload($model, 'main_img') && $this->upload($model, 'sub_img')) {
            $model = new Scent();
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Notes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $this->Scents($model, $_POST['Notes']['scent_id']) && $model->save() && $this->upload($model, 'main_img') && $this->upload($model, 'sub_img')) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /*
     * This function get model and set image extensions
     * return model
     */

    public function SetExtension($model) {
        $model->main_img = UploadedFile::getInstance($model, 'main_img');
        $model->sub_img = UploadedFile::getInstance($model, 'sub_img');
        if (isset($model->main_img)) {
            $model->main_img = $model->main_img->extension;
        } else {
            $update = Scent::findOne($model->id);
            $model->main_img = $update->main_img;
        }
        if (isset($model->sub_img)) {
            $model->sub_img = $model->sub_img->extension;
        } else {
            $update = Scent::findOne($model->id);
            $model->sub_img = $update->sub_img;
        }
        return TRUE;
    }

    /*
     * This function get scent from multiple select box and implode it with comma
     * return scent as a string
     */

    public function Scents($model, $scent) {
        if ($model != null && $scent != '') {
            $model->scent_id = implode(",", $scent);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Upload gender image based on id.
     * @return mixed
     */
    public function Upload($model, $label) {
        if ($label == 'main_img') {
            $name = 'large';
        } elseif ($label == 'sub_img') {
            $name = 'small';
        }
        $model->$label = UploadedFile::getInstance($model, $label);
        if (isset($model->$label)) {
            $filename = Yii::$app->basePath . '/../uploads/create_your_own/notes/' . $model->id . '/';
            if (!file_exists($filename)) {
                mkdir(Yii::$app->basePath . '/../uploads/create_your_own/notes/' . $model->id, 0777);
            }
            if ($model->$label->saveAs(Yii::$app->basePath . '/../uploads/create_your_own/notes/' . $model->id . '/' . $name . '.' . $model->$label->extension)) {
                if ($model->isNewRecord) {
                    $update = Notes::findOne($model->id);
                    $update->$label = $model->$label->extension;
                    $update->update();
                } else {
                    $model->$label = $model->$label->extension;
                    $model->save();
                }
            }
        } else {
            if (!$model->isNewRecord) {
                $update = Notes::findOne($model->id);
                $model->$label = $update->$label;
                $model->save();
            }
        }
        return true;
    }

    /**
     * Deletes an existing Notes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Notes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
