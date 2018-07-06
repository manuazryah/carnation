<?php

namespace backend\modules\cms\controllers;

use Yii;
use common\models\PrivateLabelOurProcess;
use common\models\PrivateLabelOurProcessSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PrivateLabelOurProcessController implements the CRUD actions for PrivateLabelOurProcess model.
 */
class PrivateLabelOurProcessController extends Controller {

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
	 * Lists all PrivateLabelOurProcess models.
	 * @return mixed
	 */
	public function actionIndex($id = null) {
		if (!empty($id)) {
			$model = $this->findModel($id);
			$message = 'Data Updated Successfully';
		} else {
			$model = new PrivateLabelOurProcess();
			$message = 'Data Added Successfully';
		}
		if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate()) {
			if ($model->save()) {
				Yii::$app->getSession()->setFlash('success', $message);
				return $this->redirect(['index']);
			}
		}
		$searchModel = new PrivateLabelOurProcessSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
			    'model' => $model,
		]);
	}

	/**
	 * Displays a single PrivateLabelOurProcess model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			    'model' => $this->findModel($id),
		]);
	}

	/**
	 * Deletes an existing PrivateLabelOurProcess model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the PrivateLabelOurProcess model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return PrivateLabelOurProcess the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = PrivateLabelOurProcess::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
