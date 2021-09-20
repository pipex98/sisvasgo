<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
use yii\helpers\StringHelper;
?>

<div class="content-wrapper">
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])): ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php else: ?>
            <h1 title="<?= $this->title ?>" class="title-update">
                <?php
                if ($this->title !== null) {
                    echo \yii\helpers\Html::encode(StringHelper::truncate($this->title, 90));
                } else {
                    echo \yii\helpers\Inflector::camel2words(
                        \yii\helpers\Inflector::id2camel($this->context->module->id)
                    );
                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php endif ?>

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </section>

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Versión</b> 1.0
    </div>
    <span class="hidden-xs">
        &copy; <?= date('Y') ?> Creado por Felipe Vásquez Gómez
    </span>
</footer>