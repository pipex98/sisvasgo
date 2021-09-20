<?php

use yii\db\Migration;

/**
 * Class m200501_003734_add_reports_menu
 */
class m200501_003734_add_reports_menu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('menu', [
            'id' => 19,
            'name' => 'Reportes',
            'parent' => null,
            'order' => 7,
            'data' => 'file',
        ]); 

        $this->insert('menu', [
            'id' => 20,
            'name' => 'Consulta Compras',
            'parent' => 19,
            'route' => '/reports/purchases-query',
            'order' => 1,
            'data' => '',
        ]);

        $this->insert('menu', [
            'id' => 21,
            'name' => 'Consulta Ventas',
            'parent' => 19,
            'route' => '/reports/sales-query',
            'order' => 2,
            'data' => '',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200501_003734_add_reports_menu cannot be reverted.\n";

        return false;
    }
}
