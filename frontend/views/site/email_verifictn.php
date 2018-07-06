<?php

use yii\helpers\Html;
?>

<html>

        <head>
                <title>Email Verification</title>


	</head>

	<body>
		<div class="mail-body" style="margin: auto;width: 50%;border: 1px solid #9e9e9e;">
			<div class="content" style="margin-left: 40px;">
				<?php echo Html::img('http://' . Yii::$app->request->serverName . '/admin/images/logo-1.png', $options = ['width' => '200px']) ?>
				<h2>Email Verification</h2>

				<p>Hi <?= $model->first_name ?>,</p>
				<p>Thank You for registering with us . please click on the below link to login</p>
				<p><a href="http://<?= Yii::$app->request->serverName ?>/site/verification?verify=<?= $val ?>" style="display: inline-block;cursor: pointer;padding: 6px 12px;font-size: 13px;line-height: 1.42857143;text-decoration: none;color: #fff;border-color: #80b636;background-color: #8dc63f;border: 1px solid transparent;">Click Here</a></p>
			</div>
		</div>



	</body>
</html>