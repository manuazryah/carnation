<?php

use yii\helpers\Html;
?>
<div class=" row empty-img">
	<img class="img-responsive" src="<?= $path; ?>"/>
</div>
<div class="clearfix"></div>
<div class="row">
    <h2><span><?= $msg; ?></span></h2>
</div>
<div class="col-md-12">
	<?= Html::a('<button class="green2">Continue shopping</button>', ['/site/index'], ['class' => 'button']) ?>
</div>

