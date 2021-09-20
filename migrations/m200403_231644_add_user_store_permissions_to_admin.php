<?php

use yii\db\Migration;

/**
 * Class m200403_231644_add_user_store_permissions_to_admin
 */
class m200403_231644_add_user_store_permissions_to_admin extends Migration
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
                ['Almacen', 2, $createTime], // Parent permission
                ['/category/activate', 2, $createTime],
                ['/category/create', 2, $createTime],
                ['/category/deactivate', 2, $createTime],
                ['/category/index', 2, $createTime],
                ['/category/update', 2, $createTime],
                ['/item/activate', 2, $createTime],
                ['/item/create', 2, $createTime],
                ['/item/deactivate', 2, $createTime],
                ['/item/index', 2, $createTime],
                ['/item/update', 2, $createTime],
            ]
        );

        // Add the child permissions to the parent
        $this->batchInsert('auth_item_child', 
            ['parent', 'child'],
            [
                ['Almacen','/category/activate'],
                ['Almacen','/category/create'],
                ['Almacen','/category/deactivate'],
                ['Almacen','/category/index'],
                ['Almacen','/category/update'],
                ['Almacen','/item/activate'],
                ['Almacen','/item/create'],
                ['Almacen','/item/deactivate'],
                ['Almacen','/item/index'],
                ['Almacen','/item/update'],
                ['superadmin','Almacen']
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200403_231644_add_user_store_permissions_to_admin cannot be reverted.\n";

        return false;
    }
}
