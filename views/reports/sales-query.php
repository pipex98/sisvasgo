<?php
use yii\helpers\Html;
use app\assets\SalesDateClientAsset;
SalesDateClientAsset::register($this);

$this->title = 'Consulta de ventas por fecha';
$this->params['breadcrumbs'][] = $this->title;
/* @var $this yii\web\View */

$baseUrl = Yii::$app->request->baseUrl;
?>
<?php if (Yii::$app->params['theme']['showTitle']): ?>
<h1><?= Html::encode($this->title) ?></h1>
<?php endif ?>

<div class="view-sales-query" 
    id="sales-date-client-mod" 
    ref="salesdatesclientapp" 
    data-base-url="<?= $baseUrl; ?>"
    data-csrf="<?=Yii::$app->request->csrfToken;?>">

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="panel-body table-responsive">

                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <label>Fecha Inicio</label>
                        <input v-model="startDate"
                            type="date" 
                            class="form-control"
                        >
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <label>Fecha Fin</label>
                        <input v-model="endDate"
                            type="date" 
                            class="form-control"
                        >
                    </div>

                    <div class="form-inline col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Cliente</label>
                        <div v-if="clientList.length">
                            <select2 :options="clientList" 
                                v-model="clientId"
                                placeholder="Seleccione un cliente">
                                <option disabled value="-1">Selecciona un cliente</option>
                            </select2>
                        </div>
                    </div>

                    <v-client-table :columns="columns" 
                        v-model="sales" 
                        :options="options">
                    </v-client-table>

                </div>
            </div>
        </div>
    </div>
</div>