<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%voucher_type}}`.
 */
class m200414_002141_create_voucher_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%voucher_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(60)->notNull()
        ]);

        $this->insert('voucher_type', [
            'name' => 'Boleta'
        ]); 

        $this->insert('voucher_type', [
            'name' => 'Factura'
        ]); 

        $this->insert('voucher_type', [
            'name' => 'Ticket'
        ]); 
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%voucher_type}}');
    }
}
