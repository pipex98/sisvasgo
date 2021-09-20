<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Deposit */

$this->title = Yii::t('deposit', 'Create Deposit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('deposit', 'Deposits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deposit-create">

    <?php if (Yii::$app->params['theme']['showTitle']): ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?php endif ?>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
