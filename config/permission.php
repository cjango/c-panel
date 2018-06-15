<?php

/**
 * 权限配置
 */
return [

    'models'                          => [
        'permission' => Spatie\Permission\Models\Permission::class,
        'role'       => Spatie\Permission\Models\Role::class,
    ],

    'table_names'                     => [
        'roles'                 => 'admin_roles',
        'permissions'           => 'admin_permissions',
        'model_has_permissions' => 'admin_model_has_permissions',
        'model_has_roles'       => 'admin_model_has_roles',
        'role_has_permissions'  => 'admin_role_has_permissions',
    ],

    'cache_expiration_time'           => 60 * 24,
    'display_permission_in_exception' => false,
];
