<?php

use yii\db\Migration;

/**
 * Class m200425_051440_add_user_sale_permissions_to_admin
 */
class m200425_051440_add_user_sale_permissions_to_admin extends Migration
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
                ['Ventas', 2, $createTime], // Parent permission
                ['/sale/activate', 2, $createTime],
                ['/sale/create', 2, $createTime],
                ['/sale/deactivate', 2, $createTime],
                ['/sale/index', 2, $createTime],
                ['/sale/view', 2, $createTime],
                ['sale/details-list', 2, $createTime],
                ['/sale/items-sale-active', 2, $createTime],
                ['/person/client-list', 2, $createTime],
            ]
        );

        // Add the child permissions to the parent
        $this->batchInsert('auth_item_child', 
            ['parent', 'child'],
            [
                ['Ventas','/sale/activate'],
                ['Ventas','/sale/create'],
                ['Ventas','/sale/deactivate'],
                ['Ventas','/sale/index'],
                ['Ventas','/sale/view'],
                ['Ventas','/sale/details-list'],
                ['Ventas','/sale/items-sale-active'],
                ['Ventas','/item/item-list'],
                ['Ventas','/person/client-list'],
                ['Ventas','/deposit/voucher-types'],
                ['superadmin','Ventas']
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200425_051440_add_user_sale_permissions_to_admin cannot be reverted.\n";

        return false;
    }
}
