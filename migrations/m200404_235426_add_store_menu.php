<?php

use yii\db\Migration;

/**
 * Class m200404_235426_add_store_menu
 */
class m200404_235426_add_store_menu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('menu', [
            'id' => 12,
            'name' => 'Almacen',
            'parent' => null,
            'order' => 3,
            'data' => 'archive',
        ]); 

        $this->insert('menu', [
            'id' => 13,
            'name' => 'Categorias',
            'parent' => 12,
            'route' => '/category/index',
            'order' => 1,
            'data' => '',
        ]);

        $this->insert('menu', [
            'id' => 14,
            'name' => 'Articulos',
            'parent' => 12,
            'route' => '/item/index',
            'order' => 2,
            'data' => '',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200404_235426_add_store_menu cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200404_235426_add_store_menu cannot be reverted.\n";

        return false;
    }
    */
}
