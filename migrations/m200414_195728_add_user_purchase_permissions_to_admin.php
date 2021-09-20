<?php

use yii\db\Migration;

/**
 * Class m200414_195728_add_user_purchase_permissions_to_admin
 */
class m200414_195728_add_user_purchase_permissions_to_admin extends Migration
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
                ['Compras', 2, $createTime], // Parent permission
                ['/deposit/activate', 2, $createTime],
                ['/deposit/create', 2, $createTime],
                ['/deposit/deactivate', 2, $createTime],
                ['/deposit/index', 2, $createTime],
                ['/deposit/view', 2, $createTime],
                ['/deposit/voucher-types', 2, $createTime],
                ['/deposit/details-list', 2, $createTime],
                ['/item/items-list', 2, $createTime],
                ['/person/supplier-list', 2, $createTime],
            ]
        );

        // Add the child permissions to the parent
        $this->batchInsert('auth_item_child', 
            ['parent', 'child'],
            [
                ['Compras','/deposit/activate'],
                ['Compras','/deposit/create'],
                ['Compras','/deposit/deactivate'],
                ['Compras','/deposit/index'],
                ['Compras','/deposit/view'],
                ['Compras','/deposit/voucher-types'],
                ['Compras','/deposit/details-list'],
                ['Compras','/item/item-list'],
                ['Compras','/person/supplier-list'],
                ['superadmin','Compras']
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200414_195728_add_user_purchase_permissions_to_admin cannot be reverted.\n";

        return false;
    }
}
