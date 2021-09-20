<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Item */

$this->title = Yii::t('item', 'Create Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('item', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-create">

    <?php if (Yii::$app->params['theme']['showTitle']): ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?php endif ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
