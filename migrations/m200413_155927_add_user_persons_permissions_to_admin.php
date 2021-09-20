<?php

use yii\db\Migration;

/**
 * Class m200413_155927_add_user_persons_permissions_to_admin
 */
class m200413_155927_add_user_persons_permissions_to_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $createTime = Yii::$app->formatter->asTimestamp(date('Y-m-d H:i:s'));

        // Insert the Autorization permissions
        $this->batchInsert('auth_item', 
            ['name', 'type', 'created_at'],
            [
                ['Personas', 2, $createTime], // Parent permission
                ['/person/activate', 2, $createTime],
                ['/person/create', 2, $createTime],
                ['/person/deactivate', 2, $createTime],
                ['/person/index', 2, $createTime],
                ['/person/update', 2, $createTime],
            ]
        );

        // Add the child permissions to the parent
        $this->batchInsert('auth_item_child', 
            ['parent', 'child'],
            [
                ['Personas','/person/activate'],
                ['Personas','/person/create'],
                ['Personas','/person/deactivate'],
                ['Personas','/person/index'],
                ['Personas','/person/update'],
                ['superadmin','Personas']
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200413_155927_add_user_persons_permissions_to_admin cannot be reverted.\n";

        return false;
    }
}
