<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m200404_000056_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'description' => $this->string(256),
            'state' => $this->boolean()->notNull()->defaultValue(1)
        ]);

        $this->createIndex('idx_unique_name_category','category','name',true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
