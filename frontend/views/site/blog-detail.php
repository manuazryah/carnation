<?php

use yii\helpers\Html;

if (isset($model->meta_title) && $model->meta_title != '')
    $this->title = $model->meta_title;
else
    $this->title = 'Carnation';
?>

<div class="pad-20 hide-xs"></div>

<div class="container">
    <div class="breadcrumb">
        <span class="current-page">Blog</span>
        <ol class="path">
            <li><?= Html::a('Home', ['/site/index'], ['class' => '']) ?></li>
            <li><?= Html::a('Blog', ['/site/our-blog'], ['class' => '']) ?></li>
            <li class="active">Blog Detail</li>
        </ol>
    </div>
</div>
<div class="container">
    <div class="sec-title">
        <div class="title"><a href="#">Carnation</a></div>
        <h2><a ><?= $model->title ?></a></h2>
        <div class="post-date"><?= date('F d' . ',' . ' Y', strtotime($model->blog_date)) ?></div>
    </div>
    <div class="news-block-one">
        <div class="inner-box">
            <div class="image col-md-4">
                <a href="#"><img src="<?= Yii::$app->homeUrl ?>uploads/cms/from-blog/<?= $model->id ?>/large.<?= $model->image ?>" style="padding-right: 12px;" alt=""></a>
            </div>
            <div class="lower-content">
                <div class="text"><?= $model->content; ?></div>
                <!--<div class="text">Donec quis ipsum purus. Pellentesque a metus rhoncus, iaculis velitis, euismod sem. In sse platea dictumst. Donec fini bus dui ac augue accumsan pretium. Nam egestas volutphat risus vitae maximus. Nam a tincidunt ipsum, molliso cons ectetur urna. Nunc hendrerit mi a cursus. Nullam a velit pharetra, eleifend nib nterdum quam. Orci variuses natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.Aenean eu porta ligula, sed dapibus mauris. In ut augue turpis. Mauris vitae rutrum risus. Sed t libero enim. Curabitur cursus metus suscipit mi fermentum, nsequat. Nunc ultrices augue libere lectus elementum nec.  </div>-->
                <!--                <div class="btn-box text-center">
                                    <a href="post-standard.html" class="theme-btn btn-style-two">Read More</a>
                                </div>-->
                <!--				<div class="post-meta clearfix col-lg-12">
                                                        <div class="pull-left">
                                                                <ul class="social-icon-one">
                                                                        <li class="share">Share:</li>
                                                                        <li><a href="#"><span class="icon fa fa-twitter"></span></a></li>
                                                                        <li><a href="#"><span class="icon fa fa-facebook"></span></a></li>
                                                                        <li><a href="#"><span class="icon fa fa-pinterest-p"></span></a></li>
                                                                </ul>
                                                        </div>
                                                        <div class="pull-right" style="padding: 6px 0; padding-right: 40px;">
                                                                <div class="tags"><a href="#"><span>by</span> Jowanna</a> <a href="#">7 Comments</a></div>
                                                        </div>
                                                </div>-->
            </div>
        </div>
    </div>
</div>

<div class="pad-20"></div>