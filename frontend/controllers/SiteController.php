<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use common\models\ForgotPasswordTokens;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\LoginForm;
use common\models\Slider;
use common\models\Subscribe;
use common\models\ContactUs;
use yii\helpers\ArrayHelper;
use common\models\Principals;
use common\models\About;
use common\models\ContactPage;
use common\models\PrivateLabelGallery;
use common\models\PrivateLabelHowItWorks;
use common\models\PrivateLabelBenefits;
use common\models\PrivateLabelOurProcess;
use common\models\Testimonials;
use common\models\PrivateLabelLogos;
use common\models\Showrooms;
use common\models\Product;
use common\models\FromOurBlog;
use common\models\CmsMetaTags;
use common\models\AboutSisterConcern;
use common\models\MapLocations;
use yii\db\Expression;

/**
 * Site controller
 */
class SiteController extends Controller {

        /**
         * @inheritdoc
         */
//    public password;

        public function behaviors() {
                return [
                    'access' => [
                        'class' => AccessControl::className(),
                        'only' => ['logout', 'signup', 'login-signup', 'product-detail', 'our-products', 'verification', 'send-response-mail', 'subscribe'],
                        'rules' => [
                                [
                                'actions' => ['signup', 'login-signup', 'product-detail', 'our-products', 'verification', 'send-response-mail', 'subscribe'],
                                'allow' => true,
                                'roles' => ['?'],
                            ],
                                [
                                'actions' => ['logout', 'signup', 'login-signup', 'product-detail', 'our-products', 'verification', 'send-response-mail', 'subscribe'],
                                'allow' => true,
                                'roles' => ['@'],
                            ],
                        ],
                    ],
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'logout' => ['post'],
                        ],
                    ],
                ];
        }

        /**
         * @inheritdoc
         */
        public function actions() {
                return [
                    'error' => [
                        'class' => 'yii\web\ErrorAction',
                    ],
                    'captcha' => [
                        'class' => 'yii\captcha\CaptchaAction',
                        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                    ],
                ];
        }

        /**
         * Displays homepage.
         *
         * @return mixed
         */
        public function actionIndex() {
                $sliders = Slider::find()->where(['status' => 1])->all();
                $about = About::find()->where(['id' => 1])->one();
                $top_categories = \common\models\Product::find(['status' => 1])->all();
                $featured_products = \common\models\Product::find(['status' => 1])->all();
                $blogs = FromOurBlog::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->all();
                $brands = \common\models\Brand::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->all();
                $home_datas = \common\models\HomeManagement::find()->orderBy(['sort_order' => SORT_ASC])->all();
                $meta_tags = CmsMetaTags::find()->where(['id' => 1])->one();
                \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
                \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
                return $this->render('index', [
                            'sliders' => $sliders,
                            'about' => $about,
                            'top_categories' => $top_categories,
                            'featured_products' => $featured_products,
                            'blogs' => $blogs,
                            'brands' => $brands,
                            'home_datas' => $home_datas,
                            'meta_title' => $meta_tags->meta_title,
                ]);
        }

        /**
         * Displays About Page.
         *
         * @return mixed
         */
        public function actionAbout() {
            
                $about = About::find()->where(['id' => 1])->one();
                $meta_tags = CmsMetaTags::find()->where(['id' => 1])->one();
                \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
                \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
                return $this->render('about', [
                            'about' => $about,
                            'meta_title' => $meta_tags->meta_title,
                ]);
        }

        /**
         * Displays Store Locator Page .
         *
         * @return mixed
         */
        public function actionStoreLocator() {
                $meta_tags = CmsMetaTags::find()->where(['id' => 4])->one();
                \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
                \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
                return $this->render('store-locator', [
'meta_title' => $meta_tags->meta_title,
                ]);
        }

        /**
         * Displays Contact Page.
         *
         * @return mixed
         */
        public function actionContact() {
                $status = '';
                $model = new ContactUs();
                $contact = ContactPage::findOne(1);
                $meta_tags = CmsMetaTags::find()->where(['id' => 7])->one();
                \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
                \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);

                if ($model->load(Yii::$app->request->post())) {
                        if ($model->save(FALSE)) {
                                $status = 1;
                                //$this->sendContactMail($model);
                        }
                }
                return $this->render('contact', [
                            'contact' => $contact,
                            'model' => $model,
                            'status' => $status,
                            'meta_title' => $meta_tags->meta_title,
                ]);
        }

        /**
         * Displays Login Page.
         *
         * @return mixed
         */
        public function actionLoginSignup() {
                if (!Yii::$app->user->isGuest) {
                        $this->redirect(['/site/index']);
                }
                $model_login = new LoginForm();
                $model = new SignupForm();
                $meta_tags = CmsMetaTags::find()->where(['id' => 16])->one();
                \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
                \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
                return $this->render('login-signup', [
                            'model_login' => $model_login,
                            'model' => $model,
                            'meta_title' => $meta_tags->meta_title,
                ]);
        }

        public function actionLogin() {
                if (!Yii::$app->user->isGuest) {
                        return $this->goHome();
                }
                $model_login = new LoginForm();
                if ($model_login->load(Yii::$app->request->post()) && $model_login->login()) {
                        if (yii::$app->session['after_login'] != '') {
                $this->redirect(array(yii::$app->session['after_login']));
            } else {
                return $this->goBack();
            }
//            return $this->goBack();
                } else {
                        $model_login->password = '';
                        return $this->render('login-signup', [
                                    'model_login' => $model_login,
                        ]);
                }
        }

        /**
         * Signs user up.
         *
         * @return mixed
         */
        public function actionSignup($go = NULL) {
                $model = new SignupForm();
$meta_tags = CmsMetaTags::find()->where(['id' => 13])->one();
                \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
                \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
                if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                        if ($user = $model->signup()) {
                                //$this->sendResponseMail($model);
                                if (Yii::$app->getUser()->login($user)) {
                                        $this->Emailregister($user);
                                        $this->Emailverification($user);
                                        if ($go) {
                                                return $this->redirect($go);
                                        } else {
                                                return $this->goHome();
                                        }
                                }
                        } else {
                              //  exit('else');
                        }
                }
                return $this->render('signup', [
                            'model' => $model,
'meta_title' => $meta_tags->meta_title,
                ]);
        }

        /**
         * After successful registration send message to the user
         *
         * @return mixed
         */
        public function Emailregister($user) {
                $message = Yii::$app->mailer->compose('new_registration', ['user' => $user])
                        ->setFrom('operations@carnation.com')
                        ->setTo(Yii::$app->params['adminEmail'])
                        ->setSubject('New User Registration');
                $message->send();
        }

        /**
         * After successful registration send email verification link to the user
         *
         * @return mixed
         */
        public function Emailverification($user) {
                $token = $user->id . '_' . 123456;
                $val = base64_encode($token);

                $message = Yii::$app->mailer->compose('email_varification', ['model' => $user, 'val' => $val]) // a view rendering result becomes the message body here
                        ->setFrom('no-replay@carnation.com')
                        ->setTo($user->email, $val)
                        ->setSubject('Email Verification');
                $message->send();
                return TRUE;
        }

        /**
         * Email Verification for new user
         *
         * @return mixed
         */
        public function actionVerification($verify) {
                $data = base64_decode($verify);
                $values = explode('_', $data);

                $model = User::find()->where(['id' => $values[0]])->one();

                if (!empty($model)) {
                        $model->email_verification = 1;
                        $model->save();
                        return $this->redirect(array('site/login'));
                } else {
                        return $this->redirect(array('site/index'));
                }
        }

        /**
         * Logs out the current user.
         *
         * @return mixed
         */
        public function actionLogout() {
                Yii::$app->user->logout();
                Yii::$app->session['orderid'] = '';
                return $this->goHome();
        }

        public function actionTermsCondition() {
                $model = Principals::findOne(1);
                $meta_tags = CmsMetaTags::find()->where(['id' => 9])->one();
                \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
                \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
                return $this->render('terms_condition', [
                            'model' => $model,
                            'meta_title' => $meta_tags->meta_title,
                ]);
        }

        public function actionPrivacyPolicy() {
                $model = Principals::findOne(1);
                $meta_tags = CmsMetaTags::find()->where(['id' => 11])->one();
                \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
                \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
                return $this->render('privacy_policy', [
                            'model' => $model,
                            'meta_title' => $meta_tags->meta_title,
                ]);
        }

        public function actionDeliveryInformation() {
                $model = Principals::findOne(1);
                $meta_tags = CmsMetaTags::find()->where(['id' => 12])->one();
                \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
                \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
                return $this->render('delivery_information', [
                            'model' => $model,
                            'meta_title' => $meta_tags->meta_title,
                ]);
        }

        public function actionSubscribe() {
                $email = $_POST['subscribe-mail'];
                $model = new Subscribe();
                $model->email = $email;
                if ($model->save()) {

                }
        }public function actionForgot() {
//        $this->layout = 'adminlogin';
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {

            $check_exists = User::find()->where(['email' => $model->email])->one();
            if (!empty($check_exists)) {

                $token_value = $this->tokenGenerator();
                $token = $check_exists->id . '_' . $token_value;
                $val = yii::$app->EncryptDecrypt->Encrypt('encrypt', $token);
                $token_model = new ForgotPasswordTokens();
                $token_model->user_id = $check_exists->id;
                $token_model->token = $token_value;
                $token_model->save();
                $this->sendMail($val, $check_exists);
                Yii::$app->getSession()->setFlash('success', 'A verification email has been sent to ' . $check_exists->email . ', please check the spam box if you can not find the mail in your inbox. ');
            } else {
                Yii::$app->getSession()->setFlash('error', 'Invalid Email');
            }
            return $this->render('forgot-password', [
                        'model' => $model,
            ]);
        } else {
            return $this->render('forgot-password', [
                        'model' => $model,
            ]);
        }
    }

    public function tokenGenerator() {

        $length = rand(1, 1000);
        $chars = array_merge(range(0, 9));
        shuffle($chars);
        $token = implode(array_slice($chars, 0, $length));
        return $token;
    }

    public function sendMail($val, $model) {

        $message = Yii::$app->mailer->compose('forgot_mail', ['model' => $model, 'val' => $val]) // a view rendering result becomes the message body here
                ->setFrom('info@coralepitome.com')
                ->setTo($model->email)
                ->setSubject('Change Password');
        $message->send();
        return TRUE;
    }

    public function actionNewPassword($token) {
//        $this->layout = 'adminlogin';
        $data = yii::$app->EncryptDecrypt->Encrypt('decrypt', $token);
        $values = explode('_', $data);
        $token_exist = ForgotPasswordTokens::find()->where("user_id = " . $values[0] . " AND token = " . $values[1])->one();
        if (!empty($token_exist)) {
            $model = User::find()->where("id = " . $token_exist->user_id)->one();
            if (Yii::$app->request->post()) {
                if (Yii::$app->request->post('new-password') == Yii::$app->request->post('confirm-password')) {
                    Yii::$app->getSession()->setFlash('success', 'password changed successfully');
                    $model->password_hash = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('confirm-password'));
//                   echo $model->password_hash;exit;
                    $model->update();
                    $token_exist->delete();
                    $this->redirect('index');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'password mismatch  ');
                }
            }
            return $this->render('new-password', [
                        'model' => $model
            ]);
        } else {
//			Yii::$app->getSession()->setFlash('error', 'Password Token not Found');
            $this->redirect('error');
        }
    }

}
