<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sale}}`.
 */
class m200422_195651_create_sale_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sale}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'voucher_type_id' => $this->integer()->notNull(),
            'voucher_sequence' => $this->string(7),
            'voucher_number' => $this->string(10)->notNull(),
            'date_hour' => $this->dateTime()->notNull(),
            'tax' => $this->decimal(4,2)->notNull(),
            'total_purchase' => $this->decimal(11,2)->notNull(),
            'state' => $this->boolean(1)->defaultValue(1)
        ]);

        $this->addForeignKey('FK_sale_person','sale','client_id','person','id','CASCADE','CASCADE');
        $this->addForeignKey('FK_sale_user','sale','user_id','user','id','CASCADE','CASCADE');
        $this->addForeignKey('FK_sale_voucher_type','sale','voucher_type_id','voucher_type','id','CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sale}}');
    }
}
