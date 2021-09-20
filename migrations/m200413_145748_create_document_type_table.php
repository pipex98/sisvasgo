<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%document_type}}`.
 */
class m200413_145748_create_document_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%document_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()
        ]);

        $this->insert('document_type', [
            'name' => 'DNI',
        ]);

        $this->insert('document_type', [
            'name' => 'RUC',
        ]);

        $this->insert('document_type', [
            'name' => 'Cedula',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%document_type}}');
    }
}
