<?php

namespace backend\modules\cms\controllers;

use Yii;
use common\models\PrivateLabelGallery;
use common\models\PrivateLabelGallerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\PrivateLabelHowItWorks;

/**
 * PrivateLabelGalleryController implements the CRUD actions for PrivateLabelGallery model.
 */
class PrivateLabelGalleryController extends Controller {

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
	 * Lists all PrivateLabelGallery models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new PrivateLabelGallerySearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single PrivateLabelGallery model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			    'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new PrivateLabelGallery model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new PrivateLabelGallery();

		if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
			$banner_image = UploadedFile::getInstance($model, 'banner_image');
			$image = UploadedFile::getInstance($model, 'image');
			$model->banner_image = $banner_image->extension;
			$model->image = $image->extension;
			if ($model->validate() && $model->save()) {
				if (!empty($banner_image)) {
					$path = Yii::$app->basePath . '/../uploads/cms/private-label/banner';
					$size = [
						['width' => 100, 'height' => 100, 'name' => 'small'],
					];
					Yii::$app->UploadFile->UploadFile($model, $banner_image, $path, $size);
				}
				if (!empty($image)) {
					$path = Yii::$app->basePath . '/../uploads/cms/private-label/images';
					$size = [
						['width' => 100, 'height' => 100, 'name' => 'small'],
					];
					Yii::$app->UploadFile->UploadFile($model, $image, $path, $size);
				}
				return $this->redirect(['view', 'id' => $model->id]);
			}
		} else {
			return $this->render('create', [
				    'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing PrivateLabelGallery model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);
		$model->setScenario('update');
		$how_it_model = new PrivateLabelHowItWorks();
		$banner_image_ = $model->banner_image;
		$image_ = $model->image;
		if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $this->SaveExtension($model, $image_, $banner_image_)) {
			$model->index_title = Yii::$app->request->post()['PrivateLabelGallery']['index_title'];
			$model->index_content = Yii::$app->request->post()['PrivateLabelGallery']['index_content'];
			if ($model->validate() && $model->save() && $this->SaveImage($model)) {
				Yii::$app->getSession()->setFlash('success', "Updated Successfully");
			}
		}
		return $this->render('update', [
			    'model' => $model,
			    'how_it_model' => $how_it_model,
		]);
	}

	function SaveExtension($model, $image_ = null, $banner_image_ = null) {
		$banner_image = UploadedFile::getInstance($model, 'banner_image');
		$image = UploadedFile::getInstance($model, 'image');

		if (!empty($banner_image))
			$model->banner_image = $banner_image->extension;
		else
			$model->banner_image = $banner_image_;
		if (!empty($image))
			$model->image = $image->extension;
		else
			$model->image = $image_;
		return $model;
	}

	function SaveImage($model) {
		$banner_image = UploadedFile::getInstance($model, 'banner_image');
		$image = UploadedFile::getInstance($model, 'image');
		if (!empty($banner_image)) {
			$path = Yii::$app->basePath . '/../uploads/cms/private-label/banner';
			$size = [
				['width' => 100, 'height' => 100, 'name' => 'small'],
			];
			Yii::$app->UploadFile->UploadFile($model, $banner_image, $path, $size);
		}
		if (!empty($image)) {
			$path = Yii::$app->basePath . '/../uploads/cms/private-label/images';
			$size = [
				['width' => 100, 'height' => 100, 'name' => 'small'],
			];
			Yii::$app->UploadFile->UploadFile($model, $image, $path, $size);
		}
		return TRUE;
	}

	/**
	 * Deletes an existing PrivateLabelGallery model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the PrivateLabelGallery model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return PrivateLabelGallery the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = PrivateLabelGallery::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
