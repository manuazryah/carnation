<?php

use yii\helpers\Html;
?>

<html>

        <head>
                <title>Forgot Password</title>
                <link href="<?= Yii::$app->homeUrl; ?>css/email.css" rel="stylesheet">
        </head>

        <body>
                <div class="mail-body" style="margin: auto;width: 50%;border: 1px solid #9e9e9e;">
                        <div class="content" style="margin-left: 40px;">
                                <?php echo Html::img('http://' . Yii::$app->request->serverName . '/admin/images/logo-1.png', $options = ['width' => '200px']) ?>
                                <h2>Change Password</h2>

                                <p>Hi <?= $model->name ?>,</p>
                                <p>You are requested to reset your password for your Admin Panel Login. Click the below button to reset it</p>
                                <p><a href="http://<?= Yii::$app->request->serverName ?>/admin/site/new-password?token=<?= $val ?>" style="display: inline-block;cursor: pointer;padding: 6px 12px;font-size: 13px;line-height: 1.42857143;text-decoration: none;color: #fff;border-color: #80b636;background-color: #8dc63f;border: 1px solid transparent;">Reset Password</a></p>
                        </div>
                </div>



        </body>
</html>