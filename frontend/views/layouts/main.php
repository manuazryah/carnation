<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;

$cart_count = common\components\Cartcount::Count();
$cart_total = common\components\Cartcount::Total();
$contact = \common\models\ContactPage::findOne(1);
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
        <title>
            <?= Html::encode($this->title) ?>
        </title>
        <script src="<?= yii::$app->homeUrl; ?>js/jquery-2.1.1.min.js"></script>
        <script>
            var homeUrl = '<?= yii::$app->homeUrl; ?>';
        </script>
        <script>

            function quickbox() {
                if ($(window).width() > 767) {
                    $('.quickview').magnificPopup({
                        type: 'iframe',
                        delegate: 'a',
                        preloader: true,
                        tLoading: 'Loading image #%curr%...',
                    });
                }
            }
            jQuery(document).ready(function () {
                quickbox();
            });
            jQuery(window).resize(function () {
                quickbox();
            });

        </script>
        <link href="<?= yii::$app->homeUrl; ?>image/catalog/cart.png" rel="icon" />
        <?php $this->head() ?>
    </head>
    <body class="common-home layout-1">
        <?php $this->beginBody() ?>
        <nav id="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="social_block">
                            <ul>
                                <li class="facebook"><a href="#"><i class="fa fa-facebook"></i> </a></li>
                                <li class="instagrm"><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li class="pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                <li class="whatsapp"><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">

                        <div id="top-links" class="nav pull-right">
                            <ul class="list-inline">
                                <li>
                                    <div class="content_headercms_top">
                                        <?php
                                        $cms_others = \common\models\CmsOthers::findOne(2);
                                        ?>

                                    </div>
                                </li>

                                <li class="dropdown myaccount"><a title="My Account" class="dropdown-toggle myaccount-menu-toggle" data-toggle="dropdown"><?= empty(Yii::$app->user->identity) ? 'Login / Signup' : 'Hello ' . Yii::$app->user->identity->first_name ?></a>
                                    <ul class="dropdown-menu dropdown-menu-right myaccount-menu">
                                        <?php if (!empty(Yii::$app->user->identity)) { ?>
                                            <li class="first">
                                                <?= Html::a('My Account', ['/myaccounts/user/index'], ['title' => 'My Account']) ?>
                                            </li>
                                            <?php
                                            echo '<li class="first">'
                                            . Html::beginForm(['/site/logout'], 'post') . '<a>'
                                            . Html::submitButton(
                                                    'Logout', ['style' => 'background-color: #4d4d4d;border: none;padding: 0px 0px 10px 0px;']
                                            ) . '</a>'
                                            . Html::endForm()
                                            . '</li>';
                                            ?>
                                        <?php } else { ?>
                                            <li>
                                                <?= Html::a('Register', ['/site/signup'], ['title' => 'Register']) ?>
                                            </li>
                                            <li>
                                                <?= Html::a('Login', ['/site/login-signup'], ['title' => 'Login']) ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="top-Search">
                            <?= Html::beginForm(['/product/index'], 'get', ['id' => 'serach-formm']) ?>
                            <div class="input-group">
                                <input type="text" class="form-control search-keyword" id="search-keyword-value" placeholder="Search Products" autocomplete="off" name="keyword" required="" value="<?php
                                if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
                                    echo $_GET['keyword'];
                                }
                                ?>">
                                <div class="search-keyword-dropdown"></div>
                                <div class="input-group-addon">
                                    <input name="search_keyword-send" type="submit" class="send" id="search-keyword-submit">
                                </div>
                            </div>
                            <?= Html::endForm() ?>
                        </div>
                        <div class="top-years">Years Of Excellence</div>
                    </div>
                </div>
            </div>
        </nav>
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="header_center_static">

                        <span class="img-icon mobile"></span>
                        <div class="call_us">
                            <div class="first">Call Us</div>
                            <div class="second">
                                <?= $contact->phone_no ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 logo">
                        <div id="logo">
                            <?= Html::a('<img src="' . yii::$app->homeUrl . 'image/catalog/logo.png" title="Carnatia" alt="Carnatia" class="img-responsive" />', ['/site/index']) ?>
                        </div>
                    </div>
                    <div class="header_right">
                        <div class="col-sm-3 header_cart">
                            <div id="cart" class="btn-group btn-block">
                                <div  data-toggle="dropdown" data-loading-text="Loading..." class="btn btn-inverse btn-block btn-lg dropdown-toggle"><span class="img-icon cart"></span>
                                    <div id="cart-total"><span class="cart_count">
                                            <?= $cart_count ?>
                                        </span> item(s)
                                        <div class="total-payment"> AED
                                            <?= sprintf("%0.2f", $cart_total) ?>
                                        </div>
                                    </div>
                                </div>
                                <ul class="dropdown-menu pull-right cart-menu">
                                    <?= common\components\CartDetailWidget::widget() ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <nav class="nav-container" role="navigation">
            <div class="nav-inner container">
                <!-- ======= Menu Code START ========= -->
                <!-- Opencart 3 level Category Menu-->
                <div id="menu" class="main-menu">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <?= Html::a('Home', ['/site/index']) ?>
                        </li>
                        <li>
                            <?= Html::a('Mens', ['/product/index', 'type' => 0], ['class' => '']) ?>
                        </li>
                        <li>
                            <?= Html::a('Womens', ['/product/index', 'type' => 1], ['class' => '']) ?>
                        </li>
                        <li>
                            <?= Html::a('Unisex', ['/product/index', 'type' => 2], ['class' => '']) ?>
                        </li>
                        <li>
                            <?= Html::a('Exclusive Brands', ['/product/index', 'category' => 'exclusive-brands'], ['class' => '']) ?>
                        </li>
                        <li>
                            <?= Html::a('Brands', ['/product/brands'], ['class' => '']) ?>
                        </li>
                        <li>
                            <?= Html::a('Store Location', ['/site/store-locator']) ?>
                        </li>
                        <li class="top_level">
                            <?= Html::a('Others', ['#']) ?>
                            <div class="categoryinner">
                                <ul>
                                    <li>
                                        <?= Html::a('Arabian Perfumes', ['#']) ?>
                                    </li>
                                    <li>
                                        <?= Html::a('Bukhoors', ['#']) ?>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <div class="custom_menu menu"> 
                        <?= Html::a('<span><span class="new-custom">new</span>Special Offer</span>', ['/product/special-offer'], ['class' => 'dasda']) ?>
                    </div>
                </div>
                <!--  =============================================== Mobile menu start  =============================================  -->
                <div id="res-menu" class="main-menu nav-container1">
                    <div class="nav-responsive"><span>Menu</span>
                        <div class="expandable"></div>
                    </div>
                    <ul class="main-navigation">
                        <li>
                            <?= Html::a('Home', ['/site/index']) ?>
                        </li>

                        <li>
                            <?= Html::a('Mens', ['/product/index', 'type' => 0], ['class' => '']) ?>
                        </li>
                        <li>
                            <?= Html::a('Womens', ['/product/index', 'type' => 1], ['class' => '']) ?>
                        </li>
                        <li>
                            <?= Html::a('Unisex', ['/product/index', 'type' => 1], ['class' => '']) ?>
                        </li>
                        <li>
                            <?= Html::a('Exclusive Brands', ['/product/index'], ['class' => '']) ?>
                        </li>
                        <li>
                            <?= Html::a('Store Location', ['/site/store-locator']) ?>
                        </li>



                        <li class="expandable"><?= Html::a('Others', ['#']) ?>
                            <ul >
                                <li> <?= Html::a('Arabian Perfumes', ['#']) ?> </li>
                                <li> <?= Html::a('Bukhoors', ['#']) ?> </li>
                            </ul>
                        </li>
                        <li>
                            <?= Html::a('Special Offer', ['/product/special-offer']) ?>
                        </li>
                    </ul>
                </div>
                <!--  ================================ Mobile menu end   ======================================   -->
                <!-- ======= Menu Code END ========= -->
            </div>
        </nav>
        <?= $content ?>
        <footer>
            <div id="footer" class="container">
                <div class="footer_inner">
                    <div class="footer_left_block col-sm-3 column">
                        <h5>About us</h5>
                        <ul class="about">
                            <li class="footer-logo"><a href="#"><img src="<?= yii::$app->homeUrl; ?>image/catalog/footer-logo.png" alt=""></a></li>
                            <li class="desc">Uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes</li>
                        </ul>
                    </div>
                    <div class="col-sm-3 column">
                        <h5>Information</h5>
                        <ul class="list-unstyled">
                            <li>
                                <?= Html::a('About Us', ['/site/about'], ['class' => '']) ?>
                            </li>
                            <li>
                                <?= Html::a('Delivery Information', ['/site/delivery-information'], ['class' => '']) ?>
                            </li>
                            <li>
                                <?= Html::a('Privacy Policy', ['/site/privacy-policy'], ['class' => '']) ?>
                            </li>
                            <li>
                                <?= Html::a('Terms &amp; Conditions', ['/site/terms-condition'], ['class' => '']) ?>
                            </li>
                            <li>
                                <?= Html::a('Contact Us', ['/site/contact'], ['class' => '']) ?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-3 column">
                        <h5>My Account</h5>
                        <ul class="list-unstyled">
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Order History</a></li>
                            <li><a href="#">Wish List</a></li>
                            <li><a href="#">Newsletter</a></li>
                            <li><a href="#">Specials</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-3 column Contact_us">
                        <h5>Contact Us</h5>
                        <ul>
                            <li class="address">Dubai Zip Code: 84606
                                City of Dubai </li>
                            <li class="phoneno"> +971 4 2638400, +971 4 2632440 </li>
                            <li class="email"><a href="#">support@carnation.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="fotter_bottom_section">
                    <script>
                        function subscribe()
                        {
                            var emailpattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                            var email = $('#txtemail').val();
                            if (email != "")
                            {
                                if (!emailpattern.test(email))
                                {
                                    $('.text-danger').remove();
                                    var str = '<span class="error">Invalid Email</span>';
                                    $('#txtemail').after('<div class="text-danger">Invalid Email</div>');

                                    return false;
                                } else
                                {
                                    $.ajax({
                                        url: 'index.php?route=extension/module/newsletters/news',
                                        type: 'post',
                                        data: 'email=' + $('#txtemail').val(),
                                        dataType: 'json',

                                        success: function (json) {

                                            $('.text-danger').remove();
                                            $('#txtemail').after('<div class="text-danger">' + json.message + '</div>');

                                        }

                                    });
                                    return false;
                                }
                            } else
                            {
                                $('.text-danger').remove();
                                $('#txtemail').after('<div class="text-danger">Email Is Require</div>');
                                $(email).focus();

                                return false;
                            }


                        }
                    </script>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-3 column newsletter">
                                <h5 class="toggle">NewsLetter<a class="mobile_togglemenu"> </a></h5>
                                <ul class="list-unstyled">
                                    <!--<form  method="post">-->
                                    <div class="subscribe-success"><p>Email Added successfully<p></div>
                                    <div class="form-group required"> <img src="<?= yii::$app->homeUrl; ?>image/catalog/envelop.png" alt="">
                                        <h3 class="toggle">NewsLetter</h3>
                                        <?php
                                        $form = ActiveForm::begin(['id' => 'subscribe-submit']);
                                        ?>
                                        <div class="col-sm-10">
                                            <input type="email" name="subscribe-mail" id="txtemail" value="" placeholder="E-Mail" class="form-control input-lg"  required=""/>
                                            <button type="submit" class="btn btn-default btn-lg" id="subscribe-submit-button">Subscribe<i class="fa fa-long-arrow-right" aria-hidden="true"></i><i class="fa fa-long-arrow-left" aria-hidden="true"></i></button>
                                        </div>
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                    <!--</form>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="footer_payment_block">
                        <ul class="payment_block">
                            <li class="visa"> <a href="#"> </a> </li>
                            <li class="mastro"> <a href="#"> </a> </li>
                            <li class="paypal"> <a href="#"> </a> </li>
                            <li class="mastercard"> <a href="#"> </a> </li>
                            <li class="discover"> <a href="#"> </a> </li>
                        </ul>
                    </div>
                </div>
                <div class="footer_bottom_links">
                    <div class="footer_bottom container">
                        <div id="links">
                            <ul>
                                <li class="first"><a href="#">Affiliates</a></li>
                                <li><a href="#">Gift Certificates</a></li>
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">Site Map</a></li>
                                <li class="last"><a href="#">Contact Us</a></li>
                            </ul>
                        </div>
                        <p>Copyright © 2018 Carnation. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
<script>
    $(document).ready(function () {
        $(".myaccount-menu-toggle").hover(function () {
            $(".myaccount-menu-toggle").addClass("active");
            $(".myaccount-menu").css("display", "block");
        });
        $('.subscribe-success').hide();
        $(document).on('submit', '#subscribe-submit', function (e) {
            e.preventDefault();
            var data = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: homeUrl + 'site/subscribe',
                data: data,
                success: function (data) {
                    $('#txtemail').val('');
                    $('.subscribe-success').show();
                    $('.subscribe-success').delay(4000).fadeOut();
                }
            });
        });
    });
</script>
