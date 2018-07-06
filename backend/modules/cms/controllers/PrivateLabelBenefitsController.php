<?php

namespace backend\modules\cms\controllers;

use Yii;
use common\models\PrivateLabelBenefits;
use common\models\PrivateLabelBenefitsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PrivateLabelBenefitsController implements the CRUD actions for PrivateLabelBenefits model.
 */
class PrivateLabelBenefitsController extends Controller {

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
	 * Lists all PrivateLabelBenefits models.
	 * @return mixed
	 */
	public function actionIndex($id = null) {
		if (!empty($id)) {
			$model = $this->findModel($id);
			$message = 'Data Updated Successfully';
		} else {
			$model = new PrivateLabelBenefits();
			$message = 'Data Added Successfully';
		}
		if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate()) {
			if ($model->save()) {
				Yii::$app->getSession()->setFlash('success', $message);
				return $this->redirect(['index']);
			}
		}
		$searchModel = new PrivateLabelBenefitsSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
			    'model' => $model,
		]);
	}

	/**
	 * Deletes an existing PrivateLabelBenefits model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDel($id) {
		$model = $this->findModel($id);
		if ($model->delete()) {
			Yii::$app->getSession()->setFlash('success', 'Deleted Successfully');
		} else {
			Yii::$app->getSession()->setFlash('error', "Can't Delete");
		}

		return $this->redirect(['index']);
	}

	/**
	 * Finds the PrivateLabelBenefits model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return PrivateLabelBenefits the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = PrivateLabelBenefits::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
