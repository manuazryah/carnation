<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\Category;
use common\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller {

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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex($id = NULL) {
        if (!empty($id)) {
            $model = $this->findModel($id);
        } else {
            $model = new Category();
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
            if (!empty($id)) {
                Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
            } else {
                Yii::$app->getSession()->setFlash('success', 'Created Successfully');
            }
            return $this->redirect(['index']);
        }
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Category model.
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
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDel($id) {
        $item_details = \common\models\SubCategory::findAll(['category_id' => $id]);
        if (empty($item_details)) {
            $product_details = \common\models\Product::find()->where(['category' => $id])->all();
            if (empty($product_details)) {
                $this->findModel($id)->delete();
                Yii::$app->getSession()->setFlash('success', 'succuessfully deleted');
            } else {
                Yii::$app->getSession()->setFlash('error', "Can't delete the Item, Error Code : PRO1");
            }
        } else {
            Yii::$app->getSession()->setFlash('error', "Can't delete the Item");
        }

//        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

//    public function actionDel($id) {
//        $item_details = \common\models\ItemMaster::findAll(['base_unit_id' => $id]);
//
//        if (empty($item_details)) {
//            $this->findModel($id)->delete();
//            Yii::$app->getSession()->setFlash('success', 'succuessfully deleted');
//        } else {
//            Yii::$app->getSession()->setFlash('error', "Can't delete the Item");
//        }
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //*******//
    public function actionAjaxaddcategory() {
        if (yii::$app->request->isAjax) {
            $main_category = Yii::$app->request->post()['main_category'];
            $category = Yii::$app->request->post()['cat'];
            $code = Yii::$app->request->post()['code'];
            $model = new Category();
            $model->main_category = $main_category;
            $model->category = $category;
            $model->category_code = $code;
            $model->status = '1';
            if (Yii::$app->SetValues->Attributes($model)) {
                if ($model->save()) {
                    echo json_encode(array("con" => "1", 'id' => $model->id, 'category' => $category)); //Success
                    exit;
//            array('id' => $model->id, 'category' => $category);
                } else {
                     echo json_encode(array("con" => "2", 'msg' => $model->getErrors())); //Failed
                    exit;
//                    var_dump($model->getErrors());
////            echo '0';
//                    exit;
                }
            }
        }
    }

}
