<?php

namespace backend\controllers;

use Yii;
use common\models\Fregrance;
use common\models\FregranceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FregranceController implements the CRUD actions for Fregrance model.
 */
class FregranceController extends Controller {
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
     * Lists all Fregrance models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new FregranceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fregrance model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Fregrance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Fregrance();

        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Fregrance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Fregrance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model1 = \common\models\Product::find()->where(['product_type' => $id])->all();
        if (empty($model1)) {
            $this->findModel($id)->delete();
        } else {
            Yii::$app->getSession()->setFlash('error', "Can't delete the Item, Error Code : PRO1");
        }

        return $this->redirect(['index']);
    }

    public function actionAjaxaddfragrance() {
        if (yii::$app->request->isAjax) {
            $fragrance = Yii::$app->request->post()['fragrance'];
            $model = new Fregrance();
            $model->name = $fragrance;
            $model->status = '1';
            if (Yii::$app->SetValues->Attributes($model)) {
                if ($model->save()) {
                    echo json_encode(array("con" => "1", 'id' => $model->id, 'fragrance' => $fragrance)); //Success
                    exit;
//            array('id' => $model->id, 'category' => $category);
                } else {
                    echo json_encode(array("con" => "0", 'error' => 'Cannot added')); //Error
                    exit;
                }
            }
        }
    }

    /**
     * Finds the Fregrance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fregrance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Fregrance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
