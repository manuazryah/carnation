<?php

namespace backend\modules\create_your_own\controllers;

use Yii;
use common\models\Bottle;
use common\models\BottleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;

/**
 * BottleController implements the CRUD actions for Bottle model.
 */
class BottleController extends Controller {

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
	 * Lists all Bottle models.
	 * @return mixed
	 */
	public function actionIndex($id = NULL) {
		if (!empty($id)) {
			$model = $this->findModel($id);
		} else {
			$model = new Bottle();
			$model->setScenario('create');
		}
//        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $this->SetExtension($model) && $model->validate() && $model->save() && $this->UploadSingle($model) && $this->UploadMultiple($model)) {
		if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $this->SetExtension($model) && $model->validate() && $model->save() && $this->UploadSingle($model)) {
			if (!empty($id)) {
				Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
			} else {
				Yii::$app->getSession()->setFlash('success', "Create Successfully");
			}
			return $this->redirect(['test', 'id' => $model->id]);
		}
		$searchModel = new BottleSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->pagination->pageSize = 5;

		return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
			    'model' => $model,
		]);
//		$model = new Bottle();
//
//		if ($model->load(Yii::$app->request->post()) && $this->SetExtension($model) && $model->validate() && $model->save() && $this->UploadSingle($model)) {
//			return $this->redirect(['test', 'id' => $model->id]);
//		} else {
//			return $this->render('create', [
//				    'model' => $model,
//			]);
//		}
	}

	public function actionTest($id) {
		$model = $this->findModel($id);
		return $this->render('test', [
			    'model' => $model,
		]);
	}

	public function actionSaveLayout() {
		$model = $this->findModel(Yii::$app->request->post()['model_id']);
		if (!empty($model)) {
			$model_data = Json::decode($model->data_positions);

			$result = Yii::$app->request->post();
			$data = [];
			$model = $this->UpdateLayout($model, $result, $data, $model_data);
		} else {

		}

		return $this->redirect(Yii::$app->request->referrer);
	}

	public function UpdateLayout($model, $result, $data, $model_data) {



		if (!empty($result['label_1_width'])) {
			if (!empty($result['label_1_y']) || (!empty($result['label_1_x']))) {
				$data['label_1'] = ['top' => $result['label_1_y'], 'left' => $result['label_1_x'], 'width' => $result['label_1_width'], 'font_size' => $result['label_1_font_size']];
			} else {
				$data['label_1'] = ['top' => $model_data['label_1']['top'], 'left' => $model_data['label_1']['left'], 'width' => $result['label_1_width'], 'font_size' => $result['label_1_font_size']];
			}
		} else {
			if (!empty($result['label_1_y']) || (!empty($result['label_1_x']))) {
				$data['label_1'] = ['top' => $result['label_1_y'], 'left' => $result['label_1_x'], 'width' => $result['label_1_width'], 'font_size' => $result['label_1_font_size']];
			} else {
				$data['label_1'] = ['top' => $model_data['label_1']['top'], 'left' => $model_data['label_1']['left'], 'width' => $model_data['label_1']['width'], 'font_size' => $result['label_1_font_size']];
			}
		}
		if (!empty($result['label_2_width'])) {

			if (!empty($result['label_2_y']) || (!empty($result['label_2_x']))) {
				$data['label_2'] = ['top' => $result['label_2_y'], 'left' => $result['label_2_x'], 'width' => $result['label_2_width'], 'font_size' => $result['label_2_font_size']];
			} else {
				$data['label_2'] = ['top' => $model_data['label_2']['top'], 'left' => $model_data['label_2']['left'], 'width' => $result['label_2_width'], 'font_size' => $result['label_2_font_size']];
			}
		} else {


			if (!empty($result['label_2_y']) || (!empty($result['label_2_x']))) {

				$data['label_2'] = ['top' => $result['label_2_y'], 'left' => $result['label_2_x'], 'width' => $result['label_2_width'], 'font_size' => $result['label_2_font_size']];
			} else {
				$data['label_2'] = ['top' => $model_data['label_2']['top'], 'left' => $model_data['label_2']['left'], 'width' => $model_data['label_2']['width'], 'font_size' => $result['label_2_font_size']];
			}
		}
		if (!empty($result['image_width']) || !empty($result['image_height'])) {



			if (!empty($result['image_x']) || (!empty($result['image_y']))) {
				$data['image'] = ['width' => $result['image_width'], 'height' => $result['image_height'], 'top' => $result['image_y'], 'left' => $result['image_x']];
			} else {

				$data['image'] = ['width' => $result['image_width'], 'height' => $result['image_height'], 'top' => $model_data['image']['top'], 'left' => $model_data['image']['left']];
			}
		} else {

			if (!empty($result['image_x']) || (!empty($result['image_y']))) {

				$data['image'] = ['width' => $model_data['image']['width'], 'height' => $model_data['image']['height'], 'top' => $result['image_y'], 'left' => $result['image_x']];
			} else {
				$data['image'] = ['width' => $model_data['image']['width'], 'height' => $model_data['image']['height'], 'top' => $model_data['image']['top'], 'left' => $model_data['image']['left']];
			}
		}
		$model->data_positions = Json::encode($data);

		$model->label_1 = $result['Bottle']['label_1'];
		$model->label_2 = $result['Bottle']['label_2'];
		$model->label_1_length = $result['Bottle']['label_1_length'];
		$model->label_2_length = $result['Bottle']['label_2_length'];


		$model->update();
		return $model;
	}

	/*
	 * This function get model and set image extensions
	 * return model
	 */

	public function SetExtension($model) {
		$model->bottle_img = UploadedFile::getInstance($model, 'bottle_img');
		if (isset($model->bottle_img)) {
			$model->bottle_img = $model->bottle_img->extension;
		} else {
			$update = Bottle::findOne($model->id);
			$model->bottle_img = $update->bottle_img;
		}
		$data = [];
		$data['label_1'] = ['top' => '69px', 'left' => '83px', 'width' => '45px', 'font_size' => '10'];
$data['label_2'] = ['top' => '69px', 'left' => '83px', 'width' => '45px', 'font_size' => '10'];
		$data['image'] = ['width' => '50', 'height' => '50','top' => '69px', 'left' => '83px'];
		$model->label_1 = 'Label 1';
		$model->label_2 = 'Label 2';
		\Yii::$app->response->format = 'json';
		$model->data_positions = Json::encode($data);
		return TRUE;
	}

	/**
	 * Upload gender image based on id.
	 * @return mixed
	 */
	public function UploadSingle($model) {
		$image = UploadedFile::getInstance($model, 'bottle_img');
		$path = Yii::$app->basePath . '/../uploads/create_your_own/bottle';
		$size = [
			['width' => 100, 'height' => 100, 'name' => 'small'],
		];

		if (!empty($image)) {
			Yii::$app->UploadFile->UploadFile($model, $image, $path . '/' . $model->id, $size);
			$iamge_size = getimagesize($path . '/' . $model->id . '/large.' . $image->extension);

			$model->image_width = $iamge_size[0];
			$model->image_height = $iamge_size[1];
			$model->update();
		}



		return TRUE;
	}

	/**
	 * Upload gender image based on id.
	 * @return mixed
	 */
	public function UploadMultiple($model) {
		$model->desigin_img = UploadedFile::getInstances($model, 'desigin_img');
		if (isset($model->desigin_img)) {
			$filename = Yii::$app->basePath . '/../uploads/create_your_own/bottle/' . $model->id . '/';
			$filename1 = Yii::$app->basePath . '/../uploads/create_your_own/bottle/' . $model->id . '/design/';
			if (!file_exists($filename)) {
				mkdir(Yii::$app->basePath . '/../uploads/create_your_own/bottle/' . $model->id, 0777);
				if (!file_exists($filename1)) {
					mkdir(Yii::$app->basePath . '/../uploads/create_your_own/bottle/' . $model->id . '/design', 0777);
				}
			} else {
				if (!file_exists($filename1)) {
					mkdir(Yii::$app->basePath . '/../uploads/create_your_own/bottle/' . $model->id . '/design', 0777);
				}
			}
			foreach ($model->desigin_img as $file) {
				$file->saveAs($filename1 . $file->baseName . '.' . $file->extension);
			}
		}
		return true;
	}

	/**
	 * Displays a single Bottle model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			    'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Bottle model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Bottle();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				    'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Bottle model.
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
	 * Deletes an existing Bottle model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Bottle model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Bottle the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Bottle::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
