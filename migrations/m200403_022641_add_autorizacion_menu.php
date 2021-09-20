<?php

use yii\db\Migration;

/**
 * Class m200403_022641_add_autorizacion_menu
 */
class m200403_022641_add_autorizacion_menu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('menu', [
            'id' => 5,
            'name' => 'Autorización',
            'parent' => null,
            'order' => 1,
            'data' => 'key',
        ]);
        
        $this->insert('menu', [
            'id' => 6,
            'name' => 'Usuarios',
            'parent' => 5,
            'route' => '/user/admin/index',
            'order' => 1,
            'data' => 'user',
        ]);
        
        $this->insert('menu', [
            'id' => 7,
            'name' => 'Menú',
            'parent' => 5,
            'route' => '/admin/menu/index',
            'order' => 2,
            'data' => 'bars',
        ]);
        
        $this->insert('menu', [
            'id' => 8,
            'name' => 'Rutas',
            'parent' => 5,
            'route' => '/admin/route/index',
            'order' => 3,
            'data' => 'level-up',
        ]);
        
        $this->insert('menu', [
            'id' => 9,
            'name' => 'Asignación',
            'parent' => 5,
            'route' => '/admin/assignment/index',
            'order' => 4,
            'data' => 'cogs',
        ]);

        $this->insert('menu', [
            'id' => 10,
            'name' => 'Permisos',
            'parent' => 5,
            'route' => '/admin/permission/index',
            'order' => 5,
            'data' => 'check-square-o',
        ]);   
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200403_022641_add_autorizacion_menu cannot be reverted.\n";

        return false;
    }
}
