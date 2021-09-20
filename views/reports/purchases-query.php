<?php
use yii\helpers\Html;
use app\assets\PurchasesDateAsset;
PurchasesDateAsset::register($this);

$this->title = 'Consulta de compras por fecha';
$this->params['breadcrumbs'][] = $this->title;
/* @var $this yii\web\View */

$baseUrl = Yii::$app->request->baseUrl;
?>
<?php if (Yii::$app->params['theme']['showTitle']): ?>
<h1><?= Html::encode($this->title) ?></h1>
<?php endif ?>

<div class="view-purchase-query"
    id="purchases-date-mod"
    ref="purchasesdateapp" 
    data-base-url="<?= $baseUrl; ?>"
    data-csrf="<?=Yii::$app->request->csrfToken;?>">

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="panel-body table-responsive">

                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Fecha Inicio</label>
                        <input type="date" v-model="startDate"
                        class="form-control">
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Fecha Fin</label>
                        <input type="date" v-model="endDate"
                            class="form-control">
                    </div>

                    <v-client-table :columns="columns" 
                        v-model="deposits" 
                        :options="options">
                    </v-client-table>

                </div>
            </div>
        </div>
    </div>
</div>