<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%person}}`.
 */
class m200413_154651_create_person_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%person}}', [
            'id' => $this->primaryKey(),
            'person_type_id' => $this->integer()->notNull(),
            'user_id' => $this->integer(),
            'name' => $this->string(100)->notNull(),
            'document_type_id' => $this->integer()->notNull(),
            'document_number' => $this->string(20),
            'address' => $this->string(70),
            'phone' => $this->string(20),
            'mail' => $this->string(50),
            'state' => $this->boolean(1)->defaultValue(1)
        ]);

        $this->addForeignKey('FK_person_document_type', 'person','document_type_id','document_type',
        'id','CASCADE','CASCADE');

        $this->addForeignKey('FK_person_person_type', 'person','person_type_id','person_type',
        'id','CASCADE','CASCADE');

        $this->addForeignKey('FK_person_user', 'person','user_id','user',
        'id','RESTRICT','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%person}}');
    }
}
