<?php

use yii\db\Migration;

/**
 * Class m200429_045244_add_desktop_menu
 */
class m200429_045244_add_desktop_menu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('menu', [
            'id' => 11,
            'name' => 'Escritorio',
            'route' => '/site/index',
            'order' => 2,
            'data' => 'desktop',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200429_045244_add_desktop_menu cannot be reverted.\n";

        return false;
    }
}
