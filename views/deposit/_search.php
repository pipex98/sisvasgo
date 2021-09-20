<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DepositSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deposit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'supplier_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'voucher_type_id') ?>

    <?= $form->field($model, 'voucher_sequence') ?>

    <?php // echo $form->field($model, 'voucher_number') ?>

    <?php // echo $form->field($model, 'date_hour') ?>

    <?php // echo $form->field($model, 'tax') ?>

    <?php // echo $form->field($model, 'total_purchase') ?>

    <?php // echo $form->field($model, 'state') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('deposit', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('deposit', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
