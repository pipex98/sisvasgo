<?php

use yii\helpers\Html;
use app\assets\SaleAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Sale */
/* @var $form yii\widgets\ActiveForm */
$baseUrl = Yii::$app->request->baseUrl;
$id = $model->id;

SaleAsset::register($this);
?>

<div class="sale-form" 
    id="sale-mod" 
    ref="saleapp" 
    data-base-url="<?= $baseUrl; ?>"
    data-csrf="<?= Yii::$app->request->csrfToken; ?>" data-model-id="<?= $id ?>">

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="panel-body">

                    <div class="form-group col-lg-8 col-md-8 col-xs-12" 
                        :class="{'has-error': $v.deposit.supplier_id.$error}">
                        <label>Proveedor</label>
                        <div v-if="supplierList.length">
                            <select2 v-if="!id" 
                                :options="supplierList" 
                                v-model.trim="$v.deposit.supplier_id.$model"
                                placeholder="Seleccione un proveedor">
                                <option disabled value="-1">Selecciona un proveedor</option>
                            </select2>
                            <div class="text-red" 
                                v-if="$v.deposit.supplier_id.$error 
                                && !$v.deposit.supplier_id.required">
                                Debes seleccionar un proveedor
                            </div>
                            <p v-else>
                                {{ supplierName }}
                            </p>
                        </div>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-xs-12"
                        :class="{'has-error': $v.deposit.voucher_type_id.$error}">
                        <label>Comprobante</label>
                        <div v-if="voucherTypes.length">
                            <select2 v-if="!id" 
                                :options="voucherTypes" 
                                v-model.trim="$v.deposit.voucher_type_id.$model"
                                placeholder="Seleccione un tipo de comprobante">
                                <option disabled value="-1">Selecciona un tipo de comprobante</option>
                            </select2>
                            <div class="text-red" 
                                v-if="$v.deposit.voucher_type_id.$error 
                                && !$v.deposit.voucher_type_id.required">
                                Debes seleccionar un tipo de comprobante
                            </div>
                            <p v-else>
                                {{ voucherName }}
                            </p>
                        </div>
                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-xs-6"
                        :class="{'has-error': $v.deposit.voucher_sequence.$error}">
                        <label>Serie Comprobante</label>
                        <input v-if="!id" 
                            type="text" 
                            class="form-control" 
                            placeholder="Serie" 
                            v-model.trim="$v.deposit.voucher_sequence.$model"
                        >
                        <div class="text-red" 
                            v-if="$v.deposit.voucher_sequence.$error 
                            && !$v.deposit.voucher_sequence.required">
                            Debes ingresar un valor
                        </div>
                        <p v-if="id">
                            {{ deposit.voucher_sequence }}
                        </p>
                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-xs-6"
                        :class="{'has-error': $v.deposit.voucher_number.$error}">
                        <label>Numero Comprobante</label>
                        <input v-if="!id"
                            type="text" 
                            class="form-control" 
                            placeholder="Numero" 
                            v-model.trim="$v.deposit.voucher_number.$model"
                        >
                        <div class="text-red" 
                            v-if="$v.deposit.voucher_number.$error 
                            && !$v.deposit.voucher_number.required">
                            Debes ingresar un valor
                        </div>
                        <p v-if="id">
                            {{ deposit.voucher_number }}
                        </p>
                    </div>

                    <div class="form-group col-lg-2 col-md-2 col-xs-6">
                        <label>Impuesto</label>
                        <input v-if="!id" 
                            class="form-control" 
                            type="text" 
                            v-model="deposit.tax"
                        >
                        <p v-else>
                            {{ deposit.tax }}
                        </p>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <a data-toggle="modal" href="#myModal">
                                    <button v-if="!id"
                                        type="button" 
                                        class="btn btn-primary">
                                            <i class="fa fa-plus" 
                                                aria-hidden="true">
                                            </i>
                                            Agregar articulos
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-xs-12">
                        <div class="table-responsive">
                            <table ref="detalles"
                                class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Articulo</th>
                                    <th>Cantidad</th>
                                    <th>Precio Compra</th>
                                    <th>Precio Venta</th>
                                    <th>Subtotal</th>
                                </thead>
                                <tbody>
                                    <tr v-for="(item,index) in itemDetails">
                                        <td>
                                            <button v-if="!id"
                                                type="button" 
                                                class="btn btn-danger" 
                                                @click="deleteDetails(index)">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <input v-if="!id"
                                                type="hidden" 
                                                v-model="item.id"
                                            >
                                            <span v-if="!id">
                                                {{ item.name }}
                                            </span>
                                            <span v-else>
                                                {{ item.name }}
                                            </span>
                                        </td>
                                        <td>
                                            <input class="form-control"
                                                v-if="!id"
                                                type="number" 
                                                v-model="item.quantity"
                                                @input="validateQuantity(item)"
                                            >
                                            <span v-else>
                                                {{ item.quantity }}
                                            </span>
                                        </td>
                                        <td>
                                            <input class="form-control"
                                                v-if="!id"
                                                type="number" 
                                                v-model="item.purchase_price"
                                                min="1"
                                            >
                                            <span v-else>
                                                {{ parseInt(item.purchase_price) }}
                                            </span>
                                        </td>
                                        <td>
                                            <input class="form-control"
                                                v-if="!id"
                                                type="number" 
                                                v-model="item.sale_price"
                                            >
                                            <span v-else>
                                                {{ parseInt(item.sale_price) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span>{{ item | subtotal(deposit.tax) }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <th><?= Yii::t('deposit','TOTAL')?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>
                                        <h4 v-if="!id"
                                        id="total">S/. {{ calculateTotal }}</h4>
                                        <input v-if="!id"
                                        type="hidden" 
                                        v-model="calculateTotal">
                                        <h4 v-else>
                                            {{ parseInt(deposit.total_purchase) }}
                                        </h4>
                                    </th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                            
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-success" 
                            @click.prevent="saveDetail" 
                            v-if="itemDetails.length && !id && validatePricesQuantity">
                                <i class="fa fa-floppy-o" 
                                    aria-hidden="true">
                                </i>
                            Guardar
                        </button>
                        <a href="<?=Url::to(['deposit/index'])?>"
                            class="btn btn-danger">
                                <i class="fa fa-arrow-circle-left" 
                                    aria-hidden="true">
                                </i>
                            Cancelar
                        </a>
                    </div>
                </div>

                <div class="modal fade" 
                    id="myModal" 
                    tabindex="-1" 
                    role="dialog" 
                    aria-labelledby="myModalLabel"
                    aria-hidden="true">

                    <div class="modal-dialog" 
                        style="width: 65% !important;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" 
                                    class="close" 
                                    data-dismiss="modal" 
                                    aria-hidden="true">
                                        <i class="fa fa-times" 
                                            aria-hidden="true">
                                        </i>
                                </button>
                                <h4 class="modal-title">Seleccione un articulo</h4>
                            </div>

                            <div class="modal-body">
                                <v-client-table :columns="columns" 
                                    v-model="items" 
                                    :options="options">
                                    <i class="btn btn-primary fa fa-plus" 
                                        slot="options" 
                                        slot-scope="props" 
                                        @click="addDetails(props.row)">
                                    </i>
                                </v-client-table>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-default" 
                                    type="button" 
                                    data-dismiss="modal">
                                        Cerrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>