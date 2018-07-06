<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
?>
<style>
	.inner_divv{
		border: 1px solid #e1d5d5;
		min-height: 81px;
		width: 613px;
		/*margin: 94px auto;*/
		height: 186px;
		text-align: center;
		margin: 94px auto;
		left: 0;
		padding: 21px;
		right: 0;
	}
	.link_a{
		float: right;
		margin: 14px;
		color: #415ad3;
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
			     height: 50px;" src="<?= Yii::$app->homeUrl; ?>images/close.png"/>
			<h4>Sorry ,your transaction failed</h4>
			<p>Please try again after some time..</p>
			<?= Html::a('Go Back', ['site/index',], ['class' => 'link_a']) ?>
		</div>

	</div>
</div>
