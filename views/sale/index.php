<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SaleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('sale', 'Sales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-index">

    <?php if (Yii::$app->params['theme']['showTitle']): ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?php endif ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <?= Html::a(Html::tag('i','',['class' => 'fa fa-plus-circle']) . ' ' .
                    Yii::t('sale', 'Create Sale'), ['create'], ['class' => 'btn btn-success']) ?>
                </div>

                <div class="panel-body">

                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?php $dataProvider->setPagination(['pageSize' => 5]); ?>

                    <?php
                        $gridColumns = [
                            [
                                'header' => 'Options',
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{view} {delete}',
                                'buttons' => [
                                    'view' => function ($url, $model) {
                                        return Html::a('<button class="btn btn-warning btn-xs">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>', $url);
                                    },
                                    'delete' => function ($url, $model) {
                                        if ($model->state) {
                                            return Html::a('<button class="btn btn-danger btn-xs">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>', $url);
                                        } else {
                                            return Html::a('<button class="btn btn-primary btn-xs">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            </button>', $url);
                                        }
                                    },
                                ],
                                'urlCreator' => function ($action, $model) {
                                    if ($action == 'view') {
                                        return Url::to(['sale/view', 'id' => $model->id]);
                                    }
                                    if ($action == 'delete') {
                                        if ($model->state) {
                                            return Url::to(['sale/deactivate', 'id' => $model->id]);
                                        } else {
                                            return Url::to(['sale/activate', 'id' => $model->id]);
                                        }
                                    }
                                }
                            ],
                            'date_hour',
                            [
                                'attribute' => 'client_id',
                                'value' => 'client.name'
                            ],
                            [
                                'attribute' => 'user_id',
                                'value' => 'user.username'
                            ],
                            [
                                'attribute' => 'voucher_type_id',
                                'value' => 'voucherType.name'   
                            ],
                            [
                                'header' => (Yii::t('deposit','Number')),
                                'value' => function ($model) {
                                    return $model->SaleNumber;
                                }
                            ],
                            [
                                'attribute' => 'total_sale',
                                'value' => function ($model) {
                                    return intval($model->total_sale);
                                }
                            ],
                            [
                                'attribute' => 'state',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return ($model->state)?'<span class="label bg-green">Aceptado</span>':
                                    '<span class="label bg-red">Anulado</span>';
                                }
                            ]
                        ];

                        echo ExportMenu::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => $gridColumns
                        ]);

                    ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => $gridColumns
                    ]); ?>

                    <?php Pjax::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
