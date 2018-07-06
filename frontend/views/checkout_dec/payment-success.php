<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

$datas = Yii::$app->session['datas'];
$amount = $datas['amount'] / 100;
$this->title = 'Payment success';
?>
<style>
	.inner_divv{
		border: 1px solid #e1d5d5;
		min-height: 81px;
		width: 613px;
		/*margin: 94px auto;*/
		height: 243px;
		text-align: center;
		margin: 94px auto;
		left: 0;
		padding: 42px 0px;
		right: 0;
	}
	.link_a{
		float: right;
		margin: 14px;
		color: #415ad3;
	}
	.green2{
		width: auto !important;
	}
</style>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 " style="    min-height: 453px;    background: #edf7f5;">
		<div style="" class="inner_divv">
			<img class="img-responsive" style="float: none;
			     text-align: center;
			     margin: 0 auto;
			     left: 0;
			     right: 0;
			     width: 50px;
			     height: 50px;" src="<?= Yii::$app->homeUrl; ?>images/tick.png"/>
			<h4>Payment Successful</h4>
			<p>Your payment of <?= $amount ?>.00 AED has been processed....</p>
			<?= Html::a('<button class="green2">continue shopping</button>', ['site/index'], ['class' => '']) ?></div>


	</div>
</div>
