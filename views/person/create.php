<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Person */

$this->title = Yii::t('person', 'Create Person');
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Persons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-create">

    <?php if (Yii::$app->params['theme']['showTitle']): ?>
        <h1><?= Html::encode($this->title) ?></h1>
    <?php endif ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
