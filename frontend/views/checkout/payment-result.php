<?php

require 'PayTabs.php';
$paytabs = new PayTabs();
$data = $paytabs->verify_payment($p_ref);
$result = \yii\helpers\Json::encode($data);
Yii::$app->response->redirect(['checkout/payment-result', 'result' => $result]);
?>