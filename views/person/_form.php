<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\DocumentType;
use app\models\PersonType;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-form">

    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="panel-body">

                    <?php $form = ActiveForm::begin(); ?>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                        <?= $form->field($model, 'name')->textInput([
                            'maxlength' => true,
                            'placeholder' => Yii::t('person','Name')
                        ]) ?>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                        <?= $form->field($model, 'person_type_id')->dropDownList(
                            ArrayHelper::map(PersonType::getPersonType(), 'id','description')
                        ) ?>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                        <?= $form->field($model, 'document_type_id')->dropDownList(
                            ArrayHelper::map(DocumentType::getDocumentType(), 'id','name')
                        ) ?>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                        <?= $form->field($model, 'document_number')->textInput([
                            'maxlength' => true,
                            'placeholder' => Yii::t('person','Document Number')
                        ]) ?>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                        <?= $form->field($model, 'address')->textInput([
                            'maxlength' => true,
                            'placeholder' => Yii::t('person','Address')
                        ]) ?>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                        <?= $form->field($model, 'phone')->textInput([
                            'maxlength' => true,
                            'placeholder' => Yii::t('person','Phone')
                        ]) ?>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                        <?= $form->field($model, 'picture')->fileInput(['class' => 'form-control']) ?>
                        <?php if (!empty($path) && $model->picture): ?>
                            <?= Html::img($path, ['width' => '150', 'height' => '120']) ?>
                        <?php endif ?>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12">
                        <?= $form->field($model, 'mail')->textInput([
                            'maxlength' => true,
                            'placeholder' => Yii::t('person','Mail')
                        ]) ?>
                    </div>

                        <?php if(!$model->picture): ?>
                            <div class="form-group col-lg-6 col-md-6 col-xs-12">
                                <label>¿ Desea crear un usuario para esta persona ?</label>
                                <?= SwitchInput::widget([
                                    'name' => 'createUser',
                                    'pluginOptions' => [
                                        'size' => 'short',
                                        'onColor' => 'success',
                                        'offColor' => 'danger',
                                        'onText' => 'Si',
                                        'offText' => 'No',
                                    ]
                                ]);
                                ?>
                            </div>
                        <?php endif ?>

                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?= Html::submitButton(Html::tag('i','',['class' => 'fa fa-floppy-o']) . ' ' . 
                        Yii::t('person', 'Save'), ['class' => 'btn btn-success']) ?>
                        <?= Html::a(Html::tag('i','',['class' => 'fa fa-arrow-circle-left']) . ' ' .
                        Yii::t('person', 'Cancel'), ['index'], ['class' => 'btn btn-danger']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>