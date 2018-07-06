<?php

namespace backend\modules\notifications\controllers;

use Yii;
use common\models\Notification;
use common\models\NotificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotificationController implements the CRUD actions for Notification model.
 */
class NotificationController extends Controller {

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
     * Lists all Notification models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new NotificationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notification model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Notification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Notification();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Notification model.
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
     * Deletes an existing Notification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Notification::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpdateNotification() {
        if (Yii::$app->request->isAjax) {
            $id = $_POST['id'];
            $notification = \common\models\Notification::findOne(['id' => $id]);
            $notification->status = 1;
            $notification->save();
            $notifications = \common\models\Notification::find()->where(['status' => 0])->orderBy(['id' => SORT_DESC])->all();
            $count = count($notifications);
            $options = '';
            if (!empty($notifications)) {
                foreach ($notifications as $notification) {
                    $options .= '<li class="active notification-success" id="notify-' . $notification->id . '" >
                                <a>
                                                    <span class="line notification-line" style="width: 85%;padding-left: 0;cursor: pointer;" id="' . $notification->order_id . '">
                                                        <strong style="line-height: 20px;">' . $notification->content . '</strong>
                                                    </span>
                                                    <span class="line small time" style="padding-left: 0;">' . $notification->date . '
                                                    </span>
                                                    <input type="checkbox" checked="" class="iswitch iswitch-secondary disable-notification" data-id= "' . $notification->id . '" style="margin-top: -35px;float: right;" title="Closed">
                                                </a>
                                </li>';
                }
            }
            $arr_variables = array('notification-list' => $options, 'notificationcount' => $count);
            $data['result'] = $arr_variables;
            echo json_encode($data);
        }
    }

}
