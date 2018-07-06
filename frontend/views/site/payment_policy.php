<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
?>
<?php
if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'Carnation';
?>

<div class="pad-20 hide-xs"></div>

<div class="container">
    <div class="breadcrumb">
        <span class="current-page">Return Policy</span>
        <ol class="path">
            <li><?= Html::a('<span>Home</span>', ['index'], ['class' => '']) ?></li>
            <li class="active">Return Policies</li>
        </ol>
    </div>
</div>

<div id="about-page">
    <div class="container">
        <div class="row">
            <div class="principals-section terms_content">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?= $model->payment_policy ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="pad-20"></div>