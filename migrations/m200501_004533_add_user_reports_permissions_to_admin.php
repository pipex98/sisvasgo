<?php

use yii\db\Migration;

/**
 * Class m200501_004533_add_user_reports_permissions_to_admin
 */
class m200501_004533_add_user_reports_permissions_to_admin extends Migration
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
                ['Reportes', 2, $createTime], // Parent permission
                ['/reports/purchases-query', 2, $createTime],
                ['/reports/sales-query', 2, $createTime],
                ['/reports/purchases-date', 2, $createTime],
                ['/reports/sales-date-client', 2, $createTime],
                ['/reports/client-list', 2, $createTime]
            ]
        );

        $this->batchInsert('auth_item_child', 
            ['parent', 'child'],
            [
                ['Reportes','/reports/purchases-query'],
                ['Reportes','/reports/sales-query'],
                ['Reportes','/reports/purchases-date'],
                ['Reportes','/reports/sales-date-client'],
                ['Reportes','/reports/client-list'],
                ['superadmin','Reportes']
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200501_004533_add_user_reports_permissions_to_admin cannot be reverted.\n";

        return false;
    }
}
