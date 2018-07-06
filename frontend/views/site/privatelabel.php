<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'Carnation-private-label';
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="pad-20 hide-xs"></div>

<div class="container">
    <div class="breadcrumb">
        <span class="current-page">Private Label</span>
        <ol class="path">
            <li><?= Html::a('Home', ['/site/index'], ['class' => '']) ?></li>
            <li class="active">Private Label</li>
        </ol>
    </div>
</div>


<div id="privatelabel">
    <div class="inner-banner">
        <img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>uploads/cms/private-label/banner/large.<?= $gallery->banner_image ?>"/>
        <!--                <div class="col-lg-12 banner-button">
                                <button class="green2">request a quote</button>
                        </div>-->
    </div>

    <!--<div class="how-it-works">-->

    <div class="col-md-12">
        <h3 class="innerpage-hdng text-center">Private Label Manufacturing</h3>
    </div>
    <h5 class="heading text-center"><?= strtoupper($gallery->about_title) ?></h5>
    <div class="about-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p style="font-size: 14px; font-family: roboto-light; color: #8c8c8c; text-align: center;">
                        <?= $gallery->about_content ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <h5 class="heading text-center">HOW IT WORKS</h5>
    <div class="how-it-works">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 right-box">
                    <?php
                    $i = 1;
                    foreach ($how_it_works as $how_it_work) {
                        ?>
                        <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 marg-bttm-30">
                            <div class="step-1 text-left md-text-center sm-text-center xs-text-center">
                                <div class="col-lg-2">
                                    <div class="icon">
                                        <img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>uploads/cms/private-label/<?= $how_it_work->id ?>.svg" />
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <p class="sub-hdng"><?= $how_it_work->title ?></p>
                                    <p class="details"><?= $how_it_work->content ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                        $i++;
                    }
                    ?>

                </div>
            </div>
            <!--</div>-->
        </div>
    </div>

    <div class="benefits" style="background-image: url(images/privatelabel-benifits-bg.jpg)">
        <div class="container">
            <div class="row">
                <h5 class="heading text-center">BENEFITS</h5>
                <?php foreach ($benefits as $benefit) {
                    ?>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 marg-bttm-30">
                        <div class="step-1 text-center">
                            <div class="icon"><i class="<?= $benefit->font_awesome ?>" aria-hidden="true"></i></div>
                            <p class="sub-hdng"><?= $benefit->title ?></p>
                            <p class="details md-text-justify sm-text-justify xs-text-center"><?= $benefit->content ?></p>
                        </div>
                    </div>
                    <?php
                }
                ?>


            </div>
        </div>
    </div>

    <div class="our-process">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="heading text-center">OUR PROCESS</h5>
                    <p class="sub-discrip text-center"><?= $gallery->our_process_title ?></p>
                </div>
                <?php foreach ($process as $proces) {
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 marg-bttm-30">
                        <div class="card">
                            <canvas class="header-bg" width="250" height="70" id="header-blur"></canvas>
                            <div class="avatar">

                                <span class="process-icoon"><?= $proces->step ?></span>

                            </div>
                            <div class="content">
                                <p><?= $proces->content ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>







                <div class="col-lg-12">
                    <p style="font-family: roboto-light; font-size: 14px; color: #8c8c8c;"><em><?= $gallery->other_title ?></em></p>
                </div>

            </div>
        </div>
    </div>

    <div class="container" id="testimonial">
        <div class="row">
            <h5 class="heading">And yes, we have lots of happy customers!</h5>
            <p class="sub-heading">See what they're saying</p>
            <div class="col-lg-9" style="margin: 0 auto; float: none;">
                <div class="Quote">â€œ</div>
                <div class="main-gallery">
                    <?php foreach ($testimonials as $testimonial) {
                        ?>
                        <div class="gallery-cell">
                            <div class="testimonial">
                                <img class="testimonial-avatar" src="<?= Yii::$app->homeUrl; ?>uploads/cms/testimonials/<?= $testimonial->id; ?>/large.<?= $testimonial->image ?>">
                                <span class="testimonial-author"><?= $testimonial->name; ?></span>
                                <q class="testimonial-quote"><?= $testimonial->content ?></q>
                            </div>
                        </div>
                        <?php
                    }
                    ?>



                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="contact-form-box">
            <div class="col-md-12 text-center">
                <h3>Contact Us</h3>
                <p><?= $contact->content; ?></p>
            </div>
            <br class="hidden-lg hidden-md hidden-sm"/>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-feild-box margin-auto xs-pad-0">
                <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12 cntnt-center">
                    <?php $form = ActiveForm::begin(['action' => 'site/contactus', 'id' => 'private-label-form']); ?>
                    <div class="form-group col-md-6 form-group1">
                        <div class="col-md-12 first-name">
                                <!--<input required="" type="text" class="form-control" placeholder="First Name" id="usr-first-name">-->
                            <?= $form->field($contact_us, 'first_name')->textInput(['placeholder' => 'First Name', 'class' => 'form-control', 'id' => 'usr-first-name'])->label('First Name*') ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6 form-group1">
                        <div class="col-md-12 last-name">
                                <!--<input required="" type="text" class="form-control" placeholder="First Name" id="usr-first-name">-->
                            <?= $form->field($contact_us, 'last_name')->textInput(['placeholder' => 'Last Name', 'class' => 'form-control', 'id' => 'usr-first-name'])->label('Last Name*') ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6 form-group1">
                        <!--                                                <label for="usr">E-Mail Address*</label>-->
                                                                        <!--<input required="" type="email" class="form-control" placeholder="yourname@domain.com" id="mail">-->
                        <?= $form->field($contact_us, 'email')->textInput(['placeholder' => 'yourname@domain.com'])->label('E-Mail Address*') ?>
                    </div>
                    <div class="form-group col-md-6 form-group1">

                        <div class="date-dropdowns form-group1">
                                <!--<input style="padding-left: 70px;" type="phone" class="form-control" data-format="+1 (ddd) ddd-dddd" name="phone" id="phone" placeholder="555 555 5555" />-->
                            <?= $form->field($contact_us, 'mobile_no')->textInput(['placeholder' => '555 555 5555', 'data-format' => '+1 (ddd) ddd-dddd', 'style' => ''])->label('Mobile Number*') ?>

                        </div>
                    </div>
                    <div class="form-group col-md-6 form-group1">
                        <?= $form->field($contact_us, 'country')->textInput(['placeholder' => 'Country'])->label('Country*'); ?>
                    </div>
                    <div class="form-group col-md-6 form-group1">
                        <?= $form->field($contact_us, 'reason')->textArea(['rows' => 2])->label('Reason for Contact*'); ?>

                    </div>
                    <div class="g-recaptcha" id="g-recaptcha-private-label" data-sitekey="6LeDkzkUAAAAAJ41OcA2zqVF_9vujRoO8GUQfQMa"></div>
                    <!--<div class="g-recaptcha" id="g-recaptcha-private-label"></div>-->
                    <div style="text-align: center;float: none;margin: 0 auto;left: 0px;right: 0px;" class="col-lg-3"><?= Html::submitButton('submit', ['class' => 'green2']) ?></div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="customer-logos">
            <?php foreach ($logos as $logo) {
                ?>
                <div class="slide"><img src="<?= Yii::$app->homeUrl; ?>uploads/cms/logos/<?= $logo->id ?>/large.<?= $logo->image ?>"></div>
                <?php
            }
            ?>

        </div>
    </div>


</div>

<div class="pad-20"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.0.10/flickity.pkgd.min.js"></script>
<script src="<?= yii::$app->homeUrl; ?>js/testimonial.js"></script>
<script>
    $(document).ready(function () {
        $('#private-label-form').on('submit', function (e) {
            var res = grecaptcha.getResponse();
            if (res == "" || res == undefined || res.length == 0)
            {
                e.preventDefault();
                if ($("#g-recaptcha-private-label").next(".validation").length == 0) // only add if not added
                {
                    $("#g-recaptcha-private-label").after("<div class='validation' style='color:#c54040;text-align: center;font-size: 13px;margin-bottom: 14px;'>Please verify that you are not a robot</div>");
                }
            }
        });
    });
</script>
