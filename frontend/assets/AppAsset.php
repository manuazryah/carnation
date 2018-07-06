<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
        'http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300',
        'https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i',
        'https://fonts.googleapis.com/css?family=Playball',
        'https://fonts.googleapis.com/css?family=Bigshot+One',
        'https://fonts.googleapis.com/css?family=Raleway',
        'css/stylesheet.css',
        'css/carousel.css',
        'css/custom.css',
        'css/bootstrap.min.css',
        'css/lightbox.css',
        'css/animate.css',
        'css/magnific-popup.css',
        'css/owl.carousel.css',
        'css/owl.transitions.css',
        'css/lightbox.css',
        'css/lightbox.css',
        'css/responsive.css',
        'css/slick.css',
        'css/slick-theme.css',
    ];
    public $js = [
//	    'js/jquery-2.1.1.min.js',
        'js/bootstrap.min.js',
        'js/parallex.js',
        'js/custom.js',
        'js/jstree.min.js',
        'js/carousel.min.js',
        'js/megnor.min.js',
        'js/jquery.custom.min.js',
        'js/tabs.js',
        'js/lightbox-2.6.min.js',
        'js/jquery.magnific-popup.min.js',
        'js/jquery.elevatezoom.min.js',
        'js/bootstrap-notify.min.js',
//	    'js/common.js',
        'js/owl.carousel.min.js',
        'js/main.js',
        'js/slick.js',
        'js/scripts.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
