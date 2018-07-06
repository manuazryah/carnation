<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
if (isset($meta_title) && $meta_title != '')
        $this->title = $meta_title;
else
        $this->title = 'Carnation';
?>
<div class="content_breadcum">
        <div class="container">
                <ul class="breadcrumb">
                        <li><?= Html::a('<i class="fa fa-home"></i>', ['/site/index']) ?></li>
                        <li><a href="">Contact Us</a></li>
                </ul>
                <h1 class="page-title">Contact Us</h1>

        </div>
</div>
<section class="in-main-contact">
        <div class="container">
                <div class="row">
                        <div class="col-md-5">
                                <div class="contact">
                                        <div class="address">
                                                <h3>Address</h3>
                                                <?= strip_tags($contact->address_1) ?>
                                        </div>
                                        <div class="address">
                                                <h3>Phone No</h3>
                                                <p><?= $contact->phone_no ?>, <?= $contact->phone_no_1 ?></p>
                                        </div>
                                        <div class="address">
                                                <h3>Email</h3>
                                                <p><?= $contact->email ?></p>
                                        </div>
                                </div>

                        </div>
                        <div class="col-md-7">
                                <div class="map"><?= $contact->map ?></div>
                        </div>
                </div>
        </div>
</section>
<section class="in-contact-page-form"><!--in-search-result-details-contact-->
        <div class="container" >

                <h3 class="in-page-heading">Get in Touch</h3>
                <div class="row">
                        <?php if (isset($status) && $status == 1) { ?>
                                <div class="col-md-12"><p style="color: #00d400;">Your enquiry submiteed successfully. We will contact you soon !!</p></div>
                        <?php } ?>
                        <?php $form = ActiveForm::begin(); ?>
                        <div class="col-md-6"><?= $form->field($model, 'first_name')->textInput(['placeholder' => 'First Name'])->label(False) ?></div>
                        <div class="col-md-6"><?= $form->field($model, 'last_name')->textInput(['placeholder' => 'Last Name'])->label(False) ?></div>
                        <div class="col-md-6"><?= $form->field($model, 'mobile_no')->textInput(['placeholder' => 'Phone No'])->label(False) ?></div>
                        <div class="col-md-6"><?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(False) ?></div>
                        <div class="col-md-12"> <?= $form->field($model, 'reason')->textArea(['rows' => 2, 'placeholder' => 'Your Message'])->label(FALSE); ?></div>
                        <div class="col-md-12"><?= Html::submitButton('submit', ['class' => 'submit']) ?></div>
                        <?php ActiveForm::end(); ?>
                </div>
        </div>
</section>