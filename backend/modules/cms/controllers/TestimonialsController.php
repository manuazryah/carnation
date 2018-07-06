<?php

namespace backend\modules\cms\controllers;

use Yii;
use common\models\Testimonials;
use common\models\TestimonialsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * TestimonialsController implements the CRUD actions for Testimonials model.
 */
class TestimonialsController extends Controller {

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
	 * Lists all Testimonials models.
	 * @return mixed
	 */
	public function actionIndex($id = null) {
		if (!empty($id)) {
			$model = $this->findModel($id);
			$message = 'Updated Successfully';
			$image_ = $model->image;
		} else {
			$model = new Testimonials();
			$message = 'Added Successfully';
			$image_ = '';
		}
		if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $this->SaveExtension($model, $image_)) {
			if ($model->validate() && $model->save() && $this->SaveImage($model)) {
				Yii::$app->getSession()->setFlash('success', $message);
                                return $this->redirect(['index']);
			}
		}
		$searchModel = new TestimonialsSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
			    'model' => $model,
		]);
	}

	function SaveExtension($model, $image_ = null) {
		$image = UploadedFile::getInstance($model, 'image');
		if (!empty($image))
			$model->image = $image->extension;
		else
			$model->image = $image_;
		return $model;
	}

	function SaveImage($model) {
		$image = UploadedFile::getInstance($model, 'image');

		if (!empty($image)) {
			$path = Yii::$app->basePath . '/../uploads/cms/testimonials/' . $model->id;
			$size = [
				['width' => 111, 'height' => 111, 'name' => 'small'],
			];
			Yii::$app->UploadFile->UploadFile($model, $image, $path, $size);
		}

		return TRUE;
	}

	/**
	 * Displays a single Testimonials model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			    'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Testimonials model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Testimonials();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				    'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Testimonials model.
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
	 * Deletes an existing Testimonials model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDel($id) {
		$model = $this->findModel($id);
		$path = Yii::$app->basePath . '/../uploads/cms/testimonials/' . $model->id;
		if (file_exists($path))
			$this->recursiveRemoveDirectory($path);
		if ($model->delete()) {
			Yii::$app->getSession()->setFlash('success', 'Deleted Successfully');
		} else {
			Yii::$app->getSession()->setFlash('error', "Can't Delete");
		}

		return $this->redirect(['index']);
	}

	function recursiveRemoveDirectory($directory) {
		foreach (glob("{$directory}/*") as $file) {
			if (is_dir($file)) {
				recursiveRemoveDirectory($file);
			} else {
				unlink($file);
			}
		}
		FileHelper::removeDirectory($directory);
	}

	/**
	 * Finds the Testimonials model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Testimonials the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Testimonials::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
