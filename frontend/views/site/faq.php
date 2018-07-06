<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'Carnation';
?>

<div class="pad-20 hide-xs"></div>

<div class="container">
    <div class="breadcrumb">
        <span class="current-page">FAQs</span>
        <ol class="path">
            <li><?= Html::a('<span>Home</span>', ['index'], ['class' => '']) ?></li>
            <li class="active">FAQs</li>
        </ol>
    </div>
</div>

<div id="about-page">
    <div class="container">
        <div class="row">
            <div class="principals-section">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="faq_content">
                        <?= $model->faq ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="pad-20"></div>