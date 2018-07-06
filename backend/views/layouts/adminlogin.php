<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title>Carnation Admin</title>
        <!--<title><?= Html::encode($this->title) ?></title>-->
        <script src="<?= yii::$app->homeUrl; ?>/js/jquery-1.11.1.min.js"></script>
        <?php $this->head() ?>
    </head>
    <!--<body>-->
    <?php $this->beginBody() ?>
    <body class="page-body login-page">


        <div class="login-container">

            <div class="row">

                <div class="col-sm-6 login-background">

                    <script type="text/javascript">
                        jQuery(document).ready(function ($)
                        {
                            // Reveal Login form
                            setTimeout(function () {
                                $(".fade-in-effect").addClass('in');
                            }, 1);


                            // Validation and Ajax action
                            $("form#login").validate({
                                rules: {
                                    username: {
                                        required: true
                                    },

                                    passwd: {
                                        required: true
                                    }
                                },

                                messages: {
                                    username: {
                                        required: 'Please enter your username.'
                                    },

                                    passwd: {
                                        required: 'Please enter your password.'
                                    }
                                },

                                // Form Processing via AJAX
                                submitHandler: function (form)
                                {
                                    show_loading_bar(70); // Fill progress bar to 70% (just a given value)

                                    var opts = {
                                        "closeButton": true,
                                        "debug": false,
                                        "positionClass": "toast-top-full-width",
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                    };

                                    $.ajax({
                                        url: "data/login-check.php",
                                        method: 'POST',
                                        dataType: 'json',
                                        data: {
                                            do_login: true,
                                            username: $(form).find('#username').val(),
                                            passwd: $(form).find('#passwd').val(),
                                        },
                                        success: function (resp)
                                        {
                                            show_loading_bar({
                                                delay: .5,
                                                pct: 100,
                                                finish: function () {

                                                    // Redirect after successful login page (when progress bar reaches 100%)
                                                    if (resp.accessGranted)
                                                    {
                                                        window.location.href = 'dashboard-1.html';
                                                    } else
                                                    {
                                                        toastr.error("You have entered wrong password, please try again. User and password is <strong>demo/demo</strong> :)", "Invalid Login!", opts);
                                                        $(form).find('#passwd').select();
                                                    }
                                                }
                                            });

                                        }
                                    });

                                }
                            });

                            // Set Form focus
                            $("form#login .form-group:has(.form-control):first .form-control").focus();
                        });
                    </script>

                    <!-- Errors container -->
                    <div class="errors-container">


                    </div>

                    <?= $content ?>

                </div>

            </div>

        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>