<?php

use yii\db\Migration;

/**
 * Class m200413_155009_add_person_menu
 */
class m200413_155009_add_persons_menu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('menu', [
            'id' => 15,
            'name' => 'Personas',
            'route' => '/person/index',
            'order' => 4,
            'data' => 'user',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200413_155009_add_person_menu cannot be reverted.\n";

        return false;
    }
}
