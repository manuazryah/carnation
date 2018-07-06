<?php

namespace backend\modules\cms\controllers;

use Yii;
use common\models\MapLocations;
use common\models\MapLocationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MapLocationsController implements the CRUD actions for MapLocations model.
 */
class MapLocationsController extends Controller {

	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
		    'verbs' => [
			'class' => VerbFilter::className(),
			'actions' => [
			// 'delete' => ['POST'],
			],
		    ],
		];
	}

	/**
	 * Lists all MapLocations models.
	 * @return mixed
	 */
	public function actionIndex($id = NULL) {

		if (!empty($id)) {
			$model = $this->findModel($id);
			$message = "Updated Suceesfully";
		} else {

			$model = new MapLocations();
			$message = "Created Suceesfully";
		}

		if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
			if ($model->validate() && $model->save()) {
				$model = new MapLocations;
				Yii::$app->getSession()->setFlash('success', $message);
			} else {
				Yii::$app->getSession()->setFlash('success', $message);
			}
		}
		$searchModel = new MapLocationsSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
			    'model' => $model,
		]);
	}

	/**
	 * Displays a single MapLocations model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			    'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new MapLocations model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new MapLocations();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				    'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing MapLocations model.
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
	 * Deletes an existing MapLocations model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {

		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the MapLocations model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return MapLocations the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = MapLocations::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
