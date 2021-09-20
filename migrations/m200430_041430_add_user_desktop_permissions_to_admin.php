<?php

use yii\db\Migration;

/**
 * Class m200430_041430_add_user_desktop_permissions_to_admin
 */
class m200430_041430_add_user_desktop_permissions_to_admin extends Migration
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
                ['Escritorio', 2, $createTime], // Parent permission
                ['/site/index', 2, $createTime],
                ['/site/total-purchase-today', 2, $createTime],
                ['/site/purchases-last-ten-days', 2, $createTime],
                ['/site/total-sale-today', 2, $createTime],
                ['/site/sales-last-twelve-months', 2, $createTime],
            ]
        );

        // Add the child permissions to the parent
        $this->batchInsert('auth_item_child', 
            ['parent', 'child'],
            [
                ['Escritorio','/site/index'],
                ['Escritorio','/site/total-purchase-today'],
                ['Escritorio','/site/purchases-last-ten-days'],
                ['Escritorio','/site/total-sale-today'],
                ['Escritorio','/site/sales-last-twelve-months'],
                ['superadmin','Escritorio']
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200430_041430_add_user_desktop_permissions_to_admin cannot be reverted.\n";

        return false;
    }
}
