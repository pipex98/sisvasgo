<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = Yii::t('category', 'Update Category: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('category', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('category', 'Update');
?>
<div class="category-update">

    <?php if (Yii::$app->params['theme']['showTitle']): ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?php endif ?>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
