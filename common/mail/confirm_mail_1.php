<?php

use yii\helpers\Html;
?>

<html>

    <head>
        <title>Confirm Order</title>
        <link href="<?= Yii::$app->homeUrl; ?>css/email.css" rel="stylesheet">
    </head>

    <body>
        <div class="mail-body" style="margin: auto;width: 50%;border: 1px solid #9e9e9e;">
            <div class="content" style="margin-left: 40px;">
                <h2 style="text-align: center;">ORDER SUCCESSFULLY CONFIRMED</h2>
                <p style="text-align: center;">Your order is successfully Confirmed. Thanks For Purchasing From Us. Your Order Id : <h3><?= $orderid?></h3></p>
            </div>
        </div>



    </body>
</html>