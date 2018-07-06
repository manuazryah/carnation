<?php

namespace backend\modules\cms\controllers;

use Yii;
use common\models\Principals;
use common\models\PrincipalsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PrincipalsController implements the CRUD actions for Principals model.
 */
class PrincipalsController extends Controller {

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
	 * Lists all Principals models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new PrincipalsSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Principals model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			    'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Principals model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Principals();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				    'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Principals model.
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
	 * Updates an existing Terms and conditions.
	 * If update is successful, the browser will be redirected to the same page.
	 * @return mixed
	 */
	public function actionTermsConditions() {
		$model = $this->findModel(1);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['terms-conditions']);
		} else {
			return $this->render('terms_condition', [
				    'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Privacy Policy.
	 * If update is successful, the browser will be redirected to the same page.
	 * @return mixed
	 */
	public function actionPrivacyPolicy() {
		$model = $this->findModel(1);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['privacy-policy']);
		} else {
			return $this->render('privacy_policy', [
				    'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Return Policy.
	 * If update is successful, the browser will be redirected to the same page.
	 * @return mixed
	 */
	public function actionReturnPolicy() {
		$model = $this->findModel(1);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['return-policy']);
		} else {
			return $this->render('return_policy', [
				    'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing FAQs.
	 * If update is successful, the browser will be redirected to the same page.
	 * @return mixed
	 */
	public function actionFaq() {
		$model = $this->findModel(1);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['faq']);
		} else {
			return $this->render('_foem_faq', [
				    'model' => $model,
			]);
		}
	}
public function actionPaymentPolicy() {
		$model = $this->findModel(1);

		if ($model->load(Yii::$app->request->post())) {
			$model->payment_policy = Yii::$app->request->post()['Principals']['payment_policy'];
			$model->save();
			return $this->redirect(['payment-policy']);
		} else {
			return $this->render('_form_payment', [
				    'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Principals model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Principals model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Principals the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Principals::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
