<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="panel-body" style="height: 400px">

                    <?php $form = ActiveForm::begin(); ?>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                        <?= $form->field($model, 'name')->textInput([
                            'maxlength' => true,
                            'placeholder' => Yii::t('category','Name')
                        ]) ?>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                        <?= $form->field($model, 'description')->textInput([
                            'maxlength' => true,
                            'placeholder' => Yii::t('category','Description')
                        ]) ?>
                    </div>

                    <!-- fa fa-floppy-o -->
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?= Html::submitButton(Html::tag('i','',['class' => 'fa fa-floppy-o']) . ' ' . 
                        Yii::t('category', 'Save'), ['class' => 'btn btn-success']) ?>
                        <?= Html::a(Html::tag('i','',['class' => 'fa fa-arrow-circle-left']) . ' ' .
                        Yii::t('category', 'Cancel'), ['index'], ['class' => 'btn btn-danger']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>