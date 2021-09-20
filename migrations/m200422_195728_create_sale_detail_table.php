<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sale_detail}}`.
 */
class m200422_195728_create_sale_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sale_detail}}', [
            'id' => $this->primaryKey(),
            'sale_id' => $this->integer()->notNull(),
            'item_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'sale_price' => $this->decimal(11,2)->notNull(),
            'discount' => $this->decimal(11,2)->notNull()
        ]);

        $this->addForeignKey('FK_sale_detail_sale','sale_detail','sale_id','sale','id','CASCADE','CASCADE');
        $this->addForeignKey('FK_sale_detail_item','sale_detail','item_id','item','id','CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sale_detail}}');
    }
}
