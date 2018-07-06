<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\MasterSearchTag;
use common\models\MasterSearchTagSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MasterSearchTagController implements the CRUD actions for MasterSearchTag model.
 */
class MasterSearchTagController extends Controller {

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
                 //   'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MasterSearchTag models.
     * @return mixed
     */
    public function actionIndex($id = NULL) {
        if (!empty($id)) {
            $model = $this->findModel($id);
        } else {
            $model = new MasterSearchTag();
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
            if (!empty($id)) {
                Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
            } else {
                Yii::$app->getSession()->setFlash('success', 'Created Successfully');
            }
            return $this->redirect(['index']);
        }
        $searchModel = new MasterSearchTagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    /**
     * Displays a single MasterSearchTag model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MasterSearchTag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new MasterSearchTag();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MasterSearchTag model.
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
     * Deletes an existing MasterSearchTag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionAjaxaddtag() {
        if (yii::$app->request->isAjax) {
            $tag_new = '';
            $model_id = array();
            $tags = Yii::$app->request->post()['tag'];
            $tag_names = explode(',', $tags);
//            $tag_name =Yii::$app->request->post()['tag'];
            foreach ($tag_names as $tag_name) {
            $tag = MasterSearchTag::find()->where(['tag_name' => $tag_name])->one();
            if (empty($tag)) {
                    $model = new MasterSearchTag();
                    $model->tag_name = $tag_name;
                    $model->status = '1';
                    if (Yii::$app->SetValues->Attributes($model)) {
                        if ($model->save()) {
                            $save = 1;
                            $new_tag[] = ['name' => $tag_name, 'id' => $model->id];
                        }
                    }
                } else {
                    $taags[] = $tag_name;
                    $model_id[] = $tag->id;
                }
            }
             if ($save == 1) {
                foreach ($new_tag as $new) {
                    $tag_new .= '<option value="' . $new['id'] . '">' . $new['name'] . '</option>';
                    $model_id[] = $new['id'];
                }
                echo json_encode(array("con" => "1", 'id' => $model_id, 'tag' => $tag_new)); //Success
                exit;
            } else {
                $arr = implode(',', $taags);
                echo json_encode(array("con" => "2", 'id' => $model_id, 'error' => $arr . ' Already used')); //Success
                exit;
//                echo '<pre>';
//                print_r($arr);
//                exit;
            }
            
        }
    }

    /**
     * Finds the MasterSearchTag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MasterSearchTag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MasterSearchTag::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
