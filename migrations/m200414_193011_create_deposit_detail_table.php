<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%deposit_detail}}`.
 */
class m200414_193011_create_deposit_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%deposit_detail}}', [
            'id' => $this->primaryKey(),
            'deposit_id' => $this->integer()->notNull(),
            'item_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'purchase_price' => $this->decimal(11,2)->notNull(),
            'sale_price' => $this->decimal(11,2)->notNull()
        ]);

        $this->addForeignKey('FK_deposit_detail_deposit','deposit_detail','deposit_id','deposit','id','CASCADE','CASCADE');
        $this->addForeignKey('FK_deposit_detail_item','deposit_detail','item_id','item','id','CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%deposit_detail}}');
    }
}
