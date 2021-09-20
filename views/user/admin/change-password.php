<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var View 	$this
 * @var User 	$user
 */

$this->title = Yii::t('custom-user', 'Change password');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <p><?= Yii::t('custom-user', 'Complete the following fields to change your password') ?></p>

                <?php $form = ActiveForm::begin([
                    'id' => 'change-password-form',
                    'options' => ['class'=>'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-3\">
                            {input}</div>\n<div class=\"col-lg-5\">
                            {error}</div>",
                        'labelOptions' => [
                            'class'=>'col-lg-3 control-label'
                        ],
                    ],
                ]); ?>

                    <?= $form->field($user,'oldpass',['inputOptions'=>[
                        'placeholder' => Yii::t('custom-user', 'Actual password')
                    ]])->passwordInput() ?>

                    <?= $form->field($user,'newpass',['inputOptions'=>[
                        'placeholder' => Yii::t('custom-user', 'New password')
                    ]])->passwordInput() ?>

                    <?= $form->field($user,'repeatnewpass',['inputOptions'=>[
                        'placeholder' => Yii::t('custom-user', 'Repeat new password')
                    ]])->passwordInput() ?>

                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-11">
                            <?= Html::submitButton(Yii::t('custom-user', 'Change password'),[
                                'class' => 'btn btn-primary btn-flat'
                            ]) ?>
                        </div>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
