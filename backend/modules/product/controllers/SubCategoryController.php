<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\SubCategory;
use common\models\SubCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SubCategoryController implements the CRUD actions for SubCategory model.
 */
class SubCategoryController extends Controller {

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
     * Lists all SubCategory models.
     * @return mixed
     */
    public function actionIndex($id = NULL) {
        if (!empty($id)) {
            $model = $this->findModel($id);
        } else {
            $model = new SubCategory();
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
            if (!empty($id)) {
                Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
            } else {
                Yii::$app->getSession()->setFlash('success', 'Created Successfully');
            }
            return $this->redirect(['index']);
        }
        $searchModel = new SubCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    /**
     * Displays a single SubCategory model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SubCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new SubCategory();

        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SubCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SubCategory model.
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
        $product_details = \common\models\Product::find()->where(['subcategory' => $id])->all();
        if (empty($product_details)) {
            if ($this->findModel($id)->delete()) {
                Yii::$app->getSession()->setFlash('success', 'succuessfully deleted');
            } else {
                Yii::$app->getSession()->setFlash('error', "Can't delete the Item");
            }
        } else {
            Yii::$app->getSession()->setFlash('error', "Can't delete the Item, Error Code : PRO1");
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the SubCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SubCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = SubCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAjaxaddsubcat() {
        if (yii::$app->request->isAjax) {
            $main_category = Yii::$app->request->post()['main_category'];
            $category = Yii::$app->request->post()['cat'];
            $subcategory = Yii::$app->request->post()['subcat'];
            $model = new SubCategory();
            $model->main_category = $main_category;
            $model->category_id = $category;
            $model->sub_category = $subcategory;
            $model->status = '1';
            if (Yii::$app->SetValues->Attributes($model)) {
                if ($model->save()) {
                    echo json_encode(array("con" => "1", 'id' => $model->id, 'subcategory' => $subcategory)); //Success
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
