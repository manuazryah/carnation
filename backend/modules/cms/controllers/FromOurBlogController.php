<?php

namespace backend\modules\cms\controllers;

use Yii;
use common\models\FromOurBlog;
use common\models\FromOurBlogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * FromOurBlogController implements the CRUD actions for FromOurBlog model.
 */
class FromOurBlogController extends Controller {

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
			//'delete' => ['POST'],
			],
		    ],
		];
	}

	/**
	 * Lists all FromOurBlog models.
	 * @return mixed
	 */
	public function actionIndex($id = NULL) {
		if (!empty($id)) {
			$model = $this->findModel($id);
		} else {
			$model = new FromOurBlog();
		}
		$ext = $model->image;
		if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
			$model->blog_date = date('Y-m-d', strtotime($model->blog_date));
			$model->meta_title = Yii::$app->request->post()['FromOurBlog']['meta_title'];
			$model->meta_description = Yii::$app->request->post()['FromOurBlog']['meta_description'];
			$model->meta_keyword = Yii::$app->request->post()['FromOurBlog']['meta_keyword'];
			$model->save();
			$image = UploadedFile::getInstance($model, 'image');

			if (!empty($image)) {
				$model->image = $image->extension;
				$path_list = Yii::$app->basePath . '/../uploads/cms/from-blog/' . $model->id;
				$this->SaveImage($image, $model, 270, 390, $path_list);
			} else {
				$model->image = $ext;
			}
			$model->update();

			if (!empty($id)) {
				Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
			} else {
				Yii::$app->getSession()->setFlash('success', 'Created Successfully');
			}
			return $this->redirect(['index']);
		}
		$searchModel = new FromOurBlogSearch();
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
	 * Displays a single FromOurBlog model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			    'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new FromOurBlog model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new FromOurBlog();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				    'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing FromOurBlog model.
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
	 * Deletes an existing FromOurBlog model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$model = $this->findModel($id);
		$path = Yii::$app->basePath . '/../uploads/cms/from-blog/' . $model->id;
		if (file_exists($path))
			$this->recursiveRemoveDirectory($path);
		if ($model->delete()) {
			Yii::$app->getSession()->setFlash('success', 'Deleted Successfully');
		} else {
			Yii::$app->getSession()->setFlash('error', "Can't Delete");
		}

		return $this->redirect(['index']);
	}

	/*
	 * to delete each image in the folder
	 */

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
	 * Finds the FromOurBlog model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return FromOurBlog the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = FromOurBlog::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
