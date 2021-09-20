<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item}}`.
 */
class m200406_174824_create_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'code' => $this->string(50),
            'name' => $this->string(100)->notNull(),
            'stock' => $this->integer()->unsigned(),
            'description' => $this->string(256),
            'image' => $this->string(50),
            'state' => $this->boolean(1)->defaultValue(1)
        ]);

        $this->addForeignKey('FK_item_category','item','category_id','category','id','CASCADE','CASCADE');
        $this->createIndex('idx_unique_name_object','item','name',true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item}}');
    }
}
