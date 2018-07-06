<?php

use yii\helpers\Html;

if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'Carnation';
?>

<div class="pad-20 hide-xs"></div>

<div class="container">
    <div class="breadcrumb">
        <span class="current-page">Blog</span>
        <ol class="path">
            <li><?= Html::a('Home', ['/site/index'], ['class' => '']) ?></li>
            <li class="active">Blog</li>
        </ol>
    </div>
</div>

<div id="blog" class="blog">
    <div class="container">
        <div class="row">
            <?php
            foreach ($model as $mode) {
                ?>
                <div class="blog-box col-md-4 col-sm-4  col-xs-12" >
                    <div class="border-box" style="    min-height: 449px;
                         max-height: 449px;">
                        <div class="img-box" style="    min-height: 226px;
                             max-height: 226px;overflow: hidden;">
                            <img class="img-responsive" src="<?= Yii::$app->homeUrl ?>uploads/cms/from-blog/<?= $mode->id ?>/large.<?= $mode->image ?>">
                        </div>
                        <h5><?= $mode->title ?></h5>
                        <ul class="date">
                            <li><i class="fa fa-calendar-check-o" aria-hidden="true"></i><?= date('M d Y', strtotime($mode->blog_date)) ?></li>
                        </ul>
                        <p><?= substr($mode->content, 0, 150); ?></p>
                        <!--						<a href="blog-detail.php">know more</a>-->
                        <?= Html::a('know more', ['blog-detail', 'id' => $mode->canonical_name]) ?>
                    </div>
                </div>
                <?php
            }
            ?>


        </div>
    </div>
</div>

<div class="pad-20"></div>