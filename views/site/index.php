<?php

/* @var $this yii\web\View */

$this->title = 'Escritorio';
use app\assets\DesktopAsset;
use yii\helpers\Url;

DesktopAsset::register($this);
$baseUrl = Yii::$app->request->baseUrl;

?>
<div class="site-index"
    id="desktop-mod" 
    ref="desktopapp" 
    data-base-url="<?= $baseUrl; ?>">

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <!--box-header-->
                <!--centro-->
                <div class="panel-body">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h4 style="font-size: 17px;">
                                    <strong>S/. {{ totalPurchase }}</strong>
                                </h4>
                                <p>Compras</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="<?= Url::to(['deposit/create']);?>" 
                                class="small-box-footer">
                                    Compras 
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h4 style="font-size: 17px;">
                                    <strong>S/. {{ totalSale }} </strong>
                                </h4>
                                <p>Ventas</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="<?= Url::to(['sale/create']);?>" 
                                class="small-box-footer">
                                    Ventas 
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                Compras de los ultimos 10 dias
                            </div>
                            <div class="box-body">
                                <line-chart v-if="loadedPurchase"
                                    :chart-data="purchasesChartData"
                                    :options="chartOptions">
                                </line-chart>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                Ventas de los ultimos 12 meses
                            </div>
                            <div class="box-body">
                                <line-chart v-if="loadedSale"
                                    :chart-data="salesChartData"
                                    :options="chartOptions">
                                </line-chart>
                            </div>
                        </div>
                    </div>
                </div>
                <!--fin centro-->
            </div>
        </div>
    </div>
</div>