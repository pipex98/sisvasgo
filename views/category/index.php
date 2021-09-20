<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('category', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <?php if (Yii::$app->params['theme']['showTitle']): ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?php endif ?>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <?= Html::a(Html::tag('i','',['class' => 'fa fa-plus-circle']) . ' ' . 
                    Yii::t('category', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
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
                                'template' => '{update} {delete}',
                                'buttons' => [
                                    'update' => function ($url, $model) {
                                        return Html::a('<button class="btn btn-warning btn-xs">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
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
                                    }
                                ],
                                'urlCreator' => function ($action, $model) {
                                    if ($action == 'update') {
                                        return Url::to(['category/update', 'id' => $model->id]);
                                    }
                                    if ($action == 'delete') {
                                        if ($model->state) {
                                            return Url::to(['category/deactivate', 'id' => $model->id]);
                                        } else {
                                            return Url::to(['category/activate', 'id' => $model->id]);
                                        }
                                    }
                                }
                            ],
                            [
                                'format' => 'raw',
                                'attribute' => 'name',
                                'value' => function ($data) {
                                    return Html::a($data['name'], [
                                        'update', 'id' => $data->id
                                    ]);
                                },
                            ],
                            'description',
                            [
                                'attribute' => 'state',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return ($model->state)?'<span class="label bg-green">Activado</span>':
                                    '<span class="label bg-red">Desactivado</span>';
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