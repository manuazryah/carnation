<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<!--<form method="post" role="form" id="login" class="login-form fade-in-effect">-->
<?php
$form = ActiveForm::begin(
                [
//                    'id' => 'login',
                    'method' => 'post',
                    'options' => [
                        'class' => 'login-form fade-in-effect'
                    ]
                ]
);
?>
<div class="login-header">
        <a href="#" class="logo">
                <img class="img-responsive" src="<?= yii::$app->homeUrl; ?>images/logo.png" alt="" />
        </a>

        <h1>Dear user, log in to access the admin area!</h1>
</div>


<div class="form-group">

        <?= $form->field($model, 'user_name')->textInput(['class' => 'form-control input-dark'], ['autofocus' => true, 'placeholder' => "Username"])->label('User Name') ?>
</div>

<div class="form-group">
        <?= $form->field($model, 'password')->passwordInput(['id' => "password", 'class' => 'form-control input-dark'], ['placeholder' => "Password"])->label('Password') ?>
</div>

<div class="form-group">
        <?= Html::submitButton('<i class="fa-lock"></i>Log In', ['class' => 'btn btn-dark  btn-block text-left']) ?>
</div>
<div class="separator">

        <p class="change_link">
                <a href="<?= yii::$app->homeUrl; ?>forgot-password" class="to_register">Forgot your password?</a>
        </p>
        <div class="clearfix"></div>
</div>

<?php ActiveForm::end(); ?>
