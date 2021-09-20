<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%person_type}}`.
 */
class m200413_154344_create_person_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%person_type}}', [
            'id' => $this->primaryKey(),
            'description' => $this->string(50)->notNull()
        ]);

        $this->insert('person_type', [
            'description' => 'Proveedor',
        ]);

        $this->insert('person_type', [
            'description' => 'Cliente',
        ]);

        $this->insert('person_type', [
            'description' => 'Usuario',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%person_type}}');
    }
}
