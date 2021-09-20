<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Item */

$this->title = Yii::t('item', 'Update Item: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('item', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('item', 'Update');
?>
<div class="item-update">

    <?php if (Yii::$app->params['theme']['showTitle']): ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?php endif ?>

    <?= $this->render('_form', [
        'model' => $model,
        'path' => $path
    ]) ?>

</div>
