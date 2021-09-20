<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = Yii::t('person', 'Update Person: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Persons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('person', 'Update');
?>
<div class="person-update">

    <?php if (Yii::$app->params['theme']['showTitle']): ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?php endif ?>

    <?= $this->render('_form', [
        'model' => $model,
        'path' => $path
    ]) ?>

</div>
