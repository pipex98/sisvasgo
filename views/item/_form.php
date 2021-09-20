<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="panel-body">

                    <?php $form = ActiveForm::begin(); ?>
                
                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                        <?= $form->field($model, 'name')->textInput([
                            'maxlength' => true,
                            'placeholder' => Yii::t('item','Name')
                        ]) ?>
                    </div>
                    
                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                        <?= $form->field($model, 'category_id')->dropDownList(
                            ArrayHelper::map(Category::getCategories(), 'id', 'name')
                        ) ?>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                        <?= $form->field($model, 'description')->textInput([
                            'maxlength' => true,
                            'placeholder' => Yii::t('item','Description')
                        ]) ?>
                    </div>
                    

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                        <?= $form->field($model, 'code')->textInput([
                            'maxlength' => true,
                            'placeholder' => Yii::t('item','Code')
                            ]) ?>
                    </div>
                    
                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                        <?= $form->field($model, 'image')->fileInput(['class' => 'form-control']) ?>
                        <?php if (!empty($path)): ?>
                            <?= Html::img($path, ['width' => '150', 'height' => '120']) ?>
                        <?php endif ?>
                    </div>
                
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?= Html::submitButton(Html::tag('i','',['class' => 'fa fa-floppy-o']) . ' ' .
                        Yii::t('item', 'Save'), ['class' => 'btn btn-success']) ?>
                        <?= Html::a(Html::tag('i','',['class' => 'fa fa-arrow-circle-left']) . ' ' .
                        Yii::t('item', 'Cancel'), ['index'], ['class' => 'btn btn-danger']) ?>
                    </div>
                
                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
    

</div>