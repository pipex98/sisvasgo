<?php

use dektrium\user\widgets\Connect;
use dektrium\user\models\LoginForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .login-box-body{
        border-radius: 5px;
    }
    .login-footer{
        background-repeat: no-repeat;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="login-box">
   
    <!-- /.login-logo -->
    <div class="login-box-body">
    <div class="login-logo">
        <a href="#"><b>SISVasgo</b></a>
    </div>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
            'validateOnBlur' => false,
            'validateOnType' => false,
            'validateOnChange' => false,
        ]) ?>

        <?php if ($module->debug): ?>
            <?= $form->field($model, 'login', [
                'inputOptions' => [
                    'autofocus' => 'autofocus',
                    'class' => 'form-control',
                    'tabindex' => '1']])->dropDownList(LoginForm::loginList());
            ?>
        <?php else: ?>
            <?= $form->field($model, 'login',
                ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]
            ); ?>
        <?php endif ?>

        <?php if ($module->debug): ?>
            <div class="alert alert-warning">
                <?= Yii::t('user', 'Password is not necessary because the module is in DEBUG mode.'); ?>
            </div>
        <?php else: ?>
            <?= $form->field( $model, 'password', [
                    'inputOptions' => [
                        'class' => 'form-control', 
                        'tabindex' => '2'
                    ]
                ])
                ->passwordInput()
                ->label( Yii::t('user', 'Password') . ($module->enablePasswordRecovery 
                    ? ' (' . Html::a( Yii::t('user', 'Forgot password?'),
                        ['/user/recovery/request'],
                        ['tabindex' => '5']
                    ) . ')' : '')
                ); ?>
        <?php endif ?>

        <?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '3']) ?>

        <?= Html::submitButton( Yii::t('user', 'Sign in'),
            ['class' => 'btn btn-primary btn-login btn-block', 'tabindex' => '4']
        ); ?>

        <?php ActiveForm::end(); ?>

        <div class="social-auth-links text-center">
            <?php if ($module->enableConfirmation): ?>
                <p class="text-center">
                    <?= Html::a(Yii::t('user', 'Didn\'t receive confirmation message?'), 
                        ['/user/registration/resend']) ?>
                </p>
            <?php endif ?>
            <?php if ($module->enableRegistration): ?>
                <p class="text-center">
                    <?= Html::a(Yii::t('user', 'Don\'t have an account? Sign up!'), 
                    ['/user/registration/register']) ?>
                </p>
            <?php endif ?>
            <?= Connect::widget([
                'baseAuthUrl' => ['/user/security/auth'],
            ]) ?>
        </div>
        <!-- /.social-auth-links --> 
    </div>
    <!-- /.login-box-body -->    
</div><!-- /.login-box -->

<footer style="margin-left:0" class="main-footer login-footer">
    <p class="text-center" style="margin-bottom:0">
        <a class="white-text" target="_blank" href="http://innovapues.com/">
            <span class="hidden-xs">
                &copy; <?= date('Y') ?> Creado por
            </span>
        </a>
    </p>
</footer>

