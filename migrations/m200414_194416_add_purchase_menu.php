<?php

use yii\db\Migration;

/**
 * Class m200414_194416_add_purchase_menu
 */
class m200414_194416_add_purchase_menu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('menu', [
            'id' => 16,
            'name' => 'Compras',
            'parent' => null,
            'order' => 5,
            'data' => 'credit-card',
        ]);
        
        $this->insert('menu', [
            'id' => 17,
            'name' => 'Ingreso',
            'parent' => 16,
            'route' => '/deposit/index',
            'order' => 1
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200414_194416_add_purchase_menu cannot be reverted.\n";

        return false;
    }
}
