<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Deposit */

$this->title = Yii::t('deposit', 'See Deposit: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('deposit', 'Deposits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('deposit', 'See');
?>
<div class="deposit-update">

    <?php if (Yii::$app->params['theme']['showTitle']): ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?php endif ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>