<?php

namespace backend\modules\cms\controllers;

use Yii;
use common\models\ShopByCategory;
use common\models\ShopByCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ShopByCategoryController implements the CRUD actions for ShopByCategory model.
 */
class ShopByCategoryController extends Controller {

	/**
	 * @inheritdoc
	 */
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
	 * Lists all ShopByCategory models.
	 * @return mixed
	 */
	public function actionIndex($id = NULL) {
		if (!empty($id)) {
			$model = $this->findModel($id);
		} else {
			$model = $this->findModel(1);
		}
		$ext = $model->image;
		if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
			$image = UploadedFile::getInstance($model, 'image');

			if (!empty($image)) {
				$model->image = $image->extension;
				$path_list = Yii::$app->basePath . '/../uploads/cms/shop-by-category/' . $model->id;
				$this->SaveImage($image, $model, 270, 390, $path_list);
			} else {
				$model->image = $ext;
			}
			$model->update();
			Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
			return $this->redirect(['index', 'id' => $model->id]);
		}
		$searchModel = new ShopByCategorySearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
			    'model' => $model,
		]);
	}

	public function SaveImage($image, $model, $width, $height, $path) {
		$size = [
			['width' => 100, 'height' => 100, 'name' => 'small'],
		];
		Yii::$app->UploadFile->UploadFile($model, $image, $path, $size);
	}

	/**
	 * Displays a single ShopByCategory model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			    'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new ShopByCategory model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
//        public function actionCreate() {
//                $model = new ShopByCategory();
//
//                if ($model->load(Yii::$app->request->post()) && $model->save()) {
//                        return $this->redirect(['view', 'id' => $model->id]);
//                } else {
//                        return $this->render('create', [
//                                    'model' => $model,
//                        ]);
//                }
//        }

	/**
	 * Updates an existing ShopByCategory model.
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
	 * Deletes an existing ShopByCategory model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the ShopByCategory model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return ShopByCategory the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = ShopByCategory::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
