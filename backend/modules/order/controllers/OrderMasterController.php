<?php

namespace backend\modules\order\controllers;

use Yii;
use common\models\OrderMaster;
use common\models\OrderMasterSearch;
use common\models\OrderDetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\CreateYourOwn;
use common\models\CreateYourOwnSearch;
use common\models\OrderDetails;

/**
 * OrderMasterController implements the CRUD actions for OrderMaster model.
 */
class OrderMasterController extends Controller {

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
     * Lists all OrderMaster models.
     * @return mixed
     */
    public function actionIndex($order_status = NULL) {
        $searchModel = new OrderMasterSearch();
        $dataProvider = $searchModel->search1(Yii::$app->request->queryParams);
        if ($order_status == '0') {
            $dataProvider->query->andWhere(['admin_status' => 0]);
        } elseif ($order_status == '4') {
            $dataProvider->query->andWhere(['admin_status' => 4]);
        } elseif ($order_status == '5') {
            $dataProvider->query->andWhere(['admin_status' => 5]);
        }
//        $dataProvider->query->andWhere(['status' => '4'])->orWhere(['status' => '5']);
        $dataProvider->pagination->pageSize = 30;
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'order_status' => $order_status,
        ]);
    }

    public function actionUserCancel() {
        $searchModel = new OrderMasterSearch();
        $dataProvider = $searchModel->searchcancel(Yii::$app->request->queryParams);
//            $dataProvider->query->andWhere(['status' => 5]);
//        $dataProvider->query->andWhere(['status' => '4'])->orWhere(['status' => '5']);
        $dataProvider->pagination->pageSize = 30;
        return $this->render('cancelindex', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderMaster model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $searchModel = new OrderDetailsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['order_id' => $id]);
                $order_master = OrderMaster::find()->where(['order_id' => $id])->one();
                $promotion_amount = \common\models\OrderPromotions::find()->where(['order_master_id' => $order_master->id])->sum('promotion_discount');
                return $this->render('view', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'orderid' => $id,
                            'promotion_amount' => $promotion_amount,
                ]);
    }
    
    public function actionCancelview($id) {
        $searchModel = new OrderDetailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['order_id' => $id]);
        $order_master = OrderMaster::find()->where(['order_id' => $id])->one();
        $promotion_amount = \common\models\OrderPromotions::find()->where(['order_master_id' => $order_master->id])->sum('promotion_discount');
        return $this->render('cancelview', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'orderid' => $id,
                    'promotion_amount' => $promotion_amount,
        ]);
    }

    /**
     * Displays a custom perfume detailed view.
     * @param integer $id
     * @return mixed
     */
    public function actionViewMore($id) {
        $order_details = OrderDetails::find()->where(['id' => $id])->one();
        $searchModel = new CreateYourOwnSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['id' => $order_details->product_id]);
        return $this->render('view_more', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * This function print order details.
     * @param integer $id
     * @return mixed
     */
    public function actionPrint($id) {
        $order_master = OrderMaster::find()->where(['order_id' => $id])->one();
        $order_details = OrderDetails::find()->where(['order_id' => $id])->all();
        $promotions = \common\models\OrderPromotions::find()->where(['order_master_id' => $order_master->id])->sum('promotion_discount');
        echo $this->renderPartial('_print', [
            'order_master' => $order_master,
            'order_details' => $order_details,
            'promotions' => $promotions
        ]);
        exit;
    }

    /**
     * Creates a new OrderMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    /**
     * Finds the OrderMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = OrderMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * This function change admin status
     * @return mixed
     */
    public function actionChangeAdminStatus() {
        if (yii::$app->request->isAjax) {
            $id = Yii::$app->request->post()['id'];
            $admin_status = Yii::$app->request->post()['status'];
            $date = Yii::$app->request->post()['date'];
            $model = OrderMaster::find()->where(['order_id' => $id])->one();
            $model->admin_status = $admin_status;
            $model->expected_delivery_date = date('Y-m-d', strtotime($date));
            if ($model->save()) {
                if ($admin_status != 0 || $admin_status != 4) {
//                if ($admin_status == 1 || $admin_status == 5) {
                    if ($admin_status == 1) {
                        $subject = 'Order Confirmed';
                        $subject_ = 'Confirmed';
$this->InvoiceNo($model);
                    }
                    if ($admin_status == 2) {
                        $subject = 'Order Packed';
                        $subject_ = 'Packed';
$this->InvoiceNo($model);
                    }
                    if ($admin_status == 3) {
                        $subject = 'Order Dispatched';
                        $subject_ = 'Dispatched';
$this->InvoiceNo($model);
                    }
                    if ($admin_status == 5) {
                        $subject = 'Order Cancelled';
                        $subject_ = 'Cancelled';
                    }
//                    if ($admin_status == 1) {
//                        $subject = 'Order Confirmation';
//                    } else if ($admin_status == 5) {
//                        $subject = 'Order Cancelled';
//                    }
                    $mail = \common\models\User::findOne($model->user_id)->email;
                    $to = $mail;
                    $message = $this->renderPartial('mail', ['orderid' => $model->order_id, 'status' => $admin_status, 'subject' => $subject_]);
                   // echo $message;
                   // exit;
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                            "From: no-replay@carnation.com";
                    mail($to, $subject, $message, $headers);
                }
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    public function InvoiceNo($model) {
                if (!isset($model->invoice_no)) {
                        $invoice = \common\models\Settings::findOne(6);
                        $model->invoice_no = $invoice->value;
                        $model->save();
                        $invoice->value = $invoice->value + 1;
                        $invoice->save();
                }
        }

    public function actionOrderdate() {
        if (yii::$app->request->isAjax) {
            $order_id = Yii::$app->request->post()['id'];
            $date = Yii::$app->request->post()['date'];
            $order= explode('-', $order_id);
            $id= $order[1];
            $model= OrderDetails::findOne($id);
            $model->delivered_date=$date;
            if($model->save()){
                echo json_encode(['msg'=>'success']);exit;
            }else{
                echo json_encode(['msg'=>'failed']);exit;
            }
        }
    }

    /**
     * This function show product wise report
     * Data taken from order details table
     * @return mixed
     */
    public function actionProductWiseReport() {
        if (Yii::$app->request->post()) {
            $from = $_POST['from_date'] . ' 00:00:00';
            $to = $_POST['to_date'] . ' 60:60:60';
            $item_id = isset($_POST['item_id'])? $_POST['item_id']: "";
            $master = OrderMaster::find()->select('id')->where(['status' => 4])->andWhere(['<>', 'status', 5])->andWhere(['<>', 'admin_status', 5])->asArray()->all();
            $arr = [];
            foreach ($master as $value) {
                $arr[] = $value['id'];
            }
            if (empty($item_id)) {
                $model = (new \yii\db\Query())
                        ->select(['product_id,SUM(rate) as net_amount,SUM(quantity) as total_quantity'])
                        ->from('order_details')
                        ->where(['>=', 'doc', $from])
                        ->andWhere(['<=', 'doc', $to])
                        ->andWhere(['in', 'master_id', $arr])
                        ->groupBy('product_id')
                        ->all();
            } else {
                $model = (new \yii\db\Query())
                        ->select(['product_id,SUM(rate) as net_amount,SUM(quantity) as total_quantity'])
                        ->from('order_details')
                        ->where(['in', 'product_id', $item_id])
                        ->andWhere(['>=', 'doc', $from])
                        ->andWhere(['<=', 'doc', $to])
                        ->andWhere(['in', 'master_id', $arr])
                        ->groupBy('product_id')
                        ->all();
            }
            $from_date = $_POST['from_date'];
            $to_date = $_POST['to_date'];
        } else {
            $master = OrderMaster::find()->select('id')->where(['status' => 4])->andWhere(['<>', 'status', 5])->andWhere(['<>', 'admin_status', 5])->asArray()->all();
            $arr = [];
            foreach ($master as $value) {
                $arr[] = $value['id'];
            }
            $from_date = date('Y-m-d');
            $to_date = date('Y-m-d');
            $item_id = '';
            $model = (new \yii\db\Query())
                    ->select(['product_id,SUM(rate) as net_amount,SUM(quantity) as total_quantity'])
                    ->from('order_details')
                    ->where(['in', 'master_id', $arr])
                    ->groupBy('product_id')
                    ->all();
        }
        return $this->render('product_wise_report', [
                    'model' => $model,
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'item_id' => $item_id,
        ]);
    }

    /**
     * This function show order wise report
     * Data taken from order master table
     * @return mixed
     */
     public function actionOrderReport() {
                $model = new OrderMaster();
                $searchModel = new OrderMasterSearch();
                $dataProvider = $searchModel->search1(Yii::$app->request->queryParams);

                if (Yii::$app->request->post()) {

                        $query = new yii\db\Query();
                        $query->select(['id'])
                                ->from('order_master');

                        if (isset($_POST['OrderMasterSearch']['order_date_from']) && $_POST['OrderMasterSearch']['order_date_from'] != '') {
                                $query->andWhere(['>=', 'order_date', $_POST['OrderMasterSearch']['order_date_from'] . ' 00:00:00']);
                                $order_date_from = $_POST['OrderMasterSearch']['order_date_from'];

                        }

                        if (isset($_POST['OrderMasterSearch']['order_date_to']) && $_POST['OrderMasterSearch']['order_date_to'] != '') {
                                $query->andWhere(['<=', 'order_date', $_POST['OrderMasterSearch']['order_date_to'] . ' 60:60:60']);
                                $order_date_to = $_POST['OrderMasterSearch']['order_date_to'];
                        }

                        if (isset($_POST['OrderMasterSearch']['order_search']) && $_POST['OrderMasterSearch']['order_search'] != '') {

                                $query->andWhere(['order_id' => $_POST['OrderMasterSearch']['order_search']]);
                                $order_search = $_POST['OrderMasterSearch']['order_search'];
                        }

                        if (isset($_POST['OrderMasterSearch']['user_search']) && $_POST['OrderMasterSearch']['user_search'] != '') {
                                $query->andWhere(['user_id' => $_POST['OrderMasterSearch']['user_search']]);
                                $user_search = $_POST['OrderMasterSearch']['user_search'];
                        }

                        if (isset($_POST['OrderMasterSearch']['amount_from']) && $_POST['OrderMasterSearch']['amount_from'] != '') {
                                $query->andWhere(['>=', 'net_amount', $_POST['OrderMasterSearch']['amount_from']]);
                                $amount_from = $_POST['OrderMasterSearch']['amount_from'];
                        }

                        if (isset($_POST['OrderMasterSearch']['amount_to']) && $_POST['OrderMasterSearch']['amount_to'] != '') {
                                $query->andWhere(['<=', 'net_amount', $_POST['OrderMasterSearch']['amount_to']]);
                                $amount_to = $_POST['OrderMasterSearch']['amount_to'];
                        }

                        $command = $query->createCommand();
                        $result = $command->queryAll();
                        $orders = array();
                        foreach ($result as $value) {
                                $orders[] = $value['id'];
                        }
                        $dataProvider->query->andWhere(['IN', 'id', $orders]);

                }

                return $this->render('order_report', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'model' => $model,
                            'order_date_from' => $order_date_from,
                            'order_date_to' => $order_date_to,
                            'order_search' => $order_search,
                            'user_search' => $user_search,
                            'amount_from' => $amount_from,
                            'amount_to' => $amount_to,
                ]);
        }

}
