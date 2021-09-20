<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\VoucherType;
use app\models\Person;
use app\assets\DepositAsset;
DepositAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\models\Deposit */
/* @var $form yii\widgets\ActiveForm */

$baseUrl = Yii::$app->request->baseUrl;
$id = $model->id;
?>

<div class="deposit-form" id="deposit-mod" ref="depositapp" data-base-url="<?= $baseUrl; ?>"
    data-csrf="<?=Yii::$app->request->csrfToken;?>" data-model-id="<?= $id ?>">

    <div class="row">
        <div class="col-md-7">
            <div class="box">
                <div class="panel-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Producto:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"
                                placeholder="Buscar por codigo de barra o nombre del producto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="box">
                <div class="panel-body">
                    <table ref="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color:#A9D0F5">
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Compra</th>
                            <th>Precio Venta</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button class="btn btn-success">
                    <i class="fa fa-floppy-o" aria-hidden="true">
                    </i>
                    Guardar
                </button>
                <a href="<?=Url::to(['deposit/index'])?>" class="btn btn-danger">
                    <i class="fa fa-arrow-circle-left" aria-hidden="true">
                    </i>
                    Cancelar
                </a>
            </div>
        </div>
    </div>

</div>