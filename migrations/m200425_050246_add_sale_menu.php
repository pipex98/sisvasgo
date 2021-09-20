<?php

use yii\db\Migration;

/**
 * Class m200425_050246_add_sale_menu
 */
class m200425_050246_add_sale_menu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('menu', [
            'id' => 18,
            'name' => 'Ventas',
            'route' => '/sale/index',
            'order' => 6,
            'data' => 'shopping-cart',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200425_050246_add_sale_menu cannot be reverted.\n";

        return false;
    }
}
