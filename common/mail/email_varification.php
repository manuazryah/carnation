<div class="content" style="margin-left: 40px;">
	<h2 style="text-align: center;">Please Verify your email address</h2>

	<p style="text-align: center;">Hi <?= $model->first_name ?>,</p>
	<p style="text-align: center;">Thank You for registering with us .</p>
	<p style="text-align: center;">To be able to send emails from this address we must verify your email address.</p>
	<p style="text-align: center;">please click on the below link to login</p>
	<p style="text-align: center;"><a href="http://<?= Yii::$app->request->serverName ?>/carnation/site/verification?verify=<?= $val ?>" style="display: inline-block;cursor: pointer;padding: 6px 12px;font-size: 13px;line-height: 1.42857143;text-decoration: none;color: #fff;border-color: #cc8305;background-color: #cc8305;border: 1px solid transparent;">Click Here</a></p>
</div>
