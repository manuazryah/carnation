<?php

namespace backend\modules\user\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Cart;
use common\models\WishListSearch;
use common\models\CartSearch;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {


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
	 * Lists all User models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new UserSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('index', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
		]);
	}

	public function actionViewCart($id) {
		$searchModel = new CartSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere(['user_id' => $id]);
		return $this->render('cart-view', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
		]);
	}

	public function actionViewWishlist($id) {
		$searchModel = new WishListSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere(['user_id' => $id]);
		return $this->render('wishlist-view', [
			    'searchModel' => $searchModel,
			    'dataProvider' => $dataProvider,
		]);
	}

	public function actionDisableUser($id) {
		$model = $this->findModel($id);
		$model->status = 0;
		$model->save();
		return $this->redirect(['index']);
	}

	/**
	 * Displays a single User model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
			    'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new User model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new User();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				    'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing User model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {

		$model = $this->findModel($id);


		if ($model->load(Yii::$app->request->post()) && $model->save()) {

			return $this->redirect(['update', 'id' => $model->id]);
		} else {

			return $this->render('update', [
				    'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing User model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = User::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

        /**
         * Active User
         * @param integer $id
         * @return mixed
         */
        public function actionApprove($id) {
                $model = $this->findModel($id);
                $model->status = 1;
                $model->save();
                return $this->redirect(['index']);
        }

        /**
         * Disable User .
         * @param integer $id
         * @return mixed
         */
        public function actionDisable($id) {
                $model = $this->findModel($id);
                $model->status = 0;
                $model->save();
                return $this->redirect(['index']);
        }

}
