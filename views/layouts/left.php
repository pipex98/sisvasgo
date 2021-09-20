<?php use mdm\admin\components\MenuHelper; ?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- search form -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <?php $callback = function($menu){
            return [
                'label' => $menu['name'],
                'url' => [$menu['route']],
                // 'options' => [$data],
                'icon' => $menu['data'],
                'items' => $menu['children']
            ];
        }; ?>

        <?= dmstr\widgets\Menu::widget([
            'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
            'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback, true),
        ]); ?>

    </section>

</aside>
