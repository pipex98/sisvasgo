<?php

use yii\db\Migration;

/**
 * Class m200403_153730_add_user_permissions_to_admin
 */
class m200403_153730_add_user_permissions_to_admin extends Migration
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
                ['Autorizacion', 2, $createTime], // Parent permission
                ['/user/admin/index', 2, $createTime],
                ['/user/admin/create', 2, $createTime],
                ['/user/admin/update', 2, $createTime],
                ['/user/admin/block', 2, $createTime],
                ['/user/admin/switch', 2, $createTime],
                ['/user/admin/assignments', 2, $createTime],
                ['/admin/menu/index', 2, $createTime],
                ['/admin/menu/create', 2, $createTime],
                ['/admin/menu/update', 2, $createTime],
                ['/admin/menu/view', 2, $createTime],
                ['/admin/route/index', 2, $createTime],
                ['/admin/route/create', 2, $createTime],
                ['/admin/route/refresh', 2, $createTime],
                ['/admin/route/assign', 2, $createTime],
                ['/admin/route/remove', 2, $createTime],
                ['/admin/assignment/revoke', 2, $createTime],
                ['/admin/assignment/assign', 2, $createTime],
                ['/admin/assignment/index', 2, $createTime],
                ['/admin/assignment/view', 2, $createTime],
                ['/admin/permission/assign', 2, $createTime],
                ['/admin/permission/index', 2, $createTime],
                ['/admin/permission/create', 2, $createTime],
                ['/admin/permission/update', 2, $createTime],
                ['/admin/permission/view', 2, $createTime],
                ['/site/index', 2, $createTime],
                ['/rbac/role/index', 2, $createTime],
                ['/rbac/role/create', 2, $createTime],
                ['/rbac/role/update', 2, $createTime],
                ['/rbac/role/delete', 2, $createTime],
                ['/rbac/permission/index', 2, $createTime],
                ['/rbac/permission/create', 2, $createTime],
                ['/rbac/permission/update', 2, $createTime],
                ['/rbac/permission/delete', 2, $createTime],
                ['/rbac/rule/index', 2, $createTime],
                ['/rbac/rule/create', 2, $createTime],
                ['/rbac/rule/update', 2, $createTime],
                ['/rbac/rule/delete', 2, $createTime],
            ]
        );

        // Add the child permissions to the parent
        $this->batchInsert('auth_item_child', 
            ['parent', 'child'],
            [
                ['Autorizacion', '/user/admin/index'],
                ['Autorizacion', '/user/admin/create'],
                ['Autorizacion', '/user/admin/update'],
                ['Autorizacion', '/user/admin/block'],
                ['Autorizacion', '/user/admin/switch'],
                ['Autorizacion', '/user/admin/assignments'],
                ['Autorizacion', '/admin/route/index'],
                ['Autorizacion', '/admin/menu/index'],
                ['Autorizacion', '/admin/menu/create'],
                ['Autorizacion', '/admin/menu/update'],
                ['Autorizacion', '/admin/menu/view'],
                ['Autorizacion', '/admin/route/create'],
                ['Autorizacion', '/admin/route/refresh'],
                ['Autorizacion', '/admin/route/assign'],
                ['Autorizacion', '/admin/route/remove'],
                ['Autorizacion', '/admin/assignment/revoke'],
                ['Autorizacion', '/admin/assignment/assign'],
                ['Autorizacion', '/admin/assignment/index'],
                ['Autorizacion', '/admin/assignment/view'],
                ['Autorizacion', '/admin/permission/assign'],
                ['Autorizacion', '/admin/permission/index'],
                ['Autorizacion', '/admin/permission/create'],
                ['Autorizacion', '/admin/permission/update'],
                ['Autorizacion', '/admin/permission/view'],
                ['Autorizacion', '/rbac/role/index'],
                ['Autorizacion', '/rbac/role/update'],
                ['Autorizacion', '/rbac/role/delete'],
                ['Autorizacion', '/rbac/permission/index'],
                ['Autorizacion', '/rbac/permission/update'],
                ['Autorizacion', '/rbac/permission/delete'],
                ['Autorizacion', '/rbac/rule/index'],
                ['Autorizacion', '/rbac/rule/update'],
                ['Autorizacion', '/rbac/rule/delete'],
                ['Autorizacion', '/rbac/role/create'],
                ['Autorizacion', '/rbac/permission/create'],
                ['Autorizacion', '/rbac/rule/create'],
                ['superadmin','/site/index'],
                ['superadmin','Autorizacion']
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200403_153730_add_user_permissions_to_admin cannot be reverted.\n";

        return false;
    }
}
