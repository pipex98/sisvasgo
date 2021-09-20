<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sale */

$this->title = Yii::t('sale', 'Create Sale');
$this->params['breadcrumbs'][] = ['label' => Yii::t('sale', 'Sales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-create">

    <?php if (Yii::$app->params['theme']['showTitle']): ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?php endif ?>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
