<?php

namespace App\Admin\Resources\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder
{
    public function run()
    {
        $sql = "INSERT INTO `menus` (`id`, `title`, `icon`, `parent_id`, `sort`, `url`, `auth`, `hide`, `status`, `created_at`, `updated_at`) VALUES
                (1, '公共页面', NULL, 0, 0, NULL, 0, 1, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (2, '主页', NULL, 1, 0, 'admin.index', 0, 1, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (3, '看板', NULL, 1, 0, 'admin.dashboard', 0, 1, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (4, '修改密码', NULL, 1, 0, 'admin.password', 0, 1, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (5, '退出登录', NULL, 1, 0, 'admin.logout', 0, 1, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (6, '编辑器接口', NULL, 1, 0, 'admin.ueditor', 0, 1, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (7, '图片上传接口', NULL, 1, 0, 'admin.storages.picture', 0, 1, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (8, '登录', NULL, 1, 0, 'admin.login', 0, 1, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (10, '系统管理', 'fa-cogs', 0, 99, NULL, 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (101, '菜单管理', 'fa-list', 10, 1, 'admin.menus.index', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (102, '新增菜单', '', 101, 99, 'admin.menus.create', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (103, '存储', NULL, 101, 99, 'admin.menus.store', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (104, '编辑菜单', NULL, 101, 99, 'admin.menus.edit', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (105, '更新', NULL, 101, 99, 'admin.menus.update', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (106, '排序', NULL, 101, 99, 'admin.menus.sort', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (107, '删除菜单', NULL, 101, 99, 'admin.menus.destroy', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (110, '权限管理', 'fa-group', 10, 2, 'admin.roles.index', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (111, '新增分组', NULL, 110, 99, 'admin.roles.create', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (112, '存储', NULL, 110, 99, 'admin.roles.store', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (113, '编辑分组', NULL, 110, 99, 'admin.roles.edit', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (114, '更新', NULL, 110, 99, 'admin.roles.update', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (115, '删除分组', NULL, 110, 99, 'admin.roles.destroy', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (116, '菜单授权', NULL, 110, 99, 'admin.roles.menus', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (117, '用户授权', NULL, 110, 99, 'admin.roles.users', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (118, '增加用户', NULL, 110, 99, 'admin.roles.auth', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (119, '删除用户', NULL, 110, 99, 'admin.roles.remove', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (150, '系统日志', 'fa-list', 10, 3, 'admin.logs.index', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (151, '删除日志', NULL, 150, 99, 'admin.logs.destroy', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (200, '用户管理', 'fa-group', 0, 98, NULL, 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (201, '用户列表', 'fa-list', 200, 99, 'admin.users.index', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (202, '新增用户', NULL, 201, 99, 'admin.users.create', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (203, '存储', NULL, 201, 99, 'admin.users.store', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (204, '编辑用户', NULL, 201, 99, 'admin.users.edit', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (205, '更新', NULL, 201, 99, 'admin.users.update', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (206, '删除用户', NULL, 201, 99, 'admin.users.destroy', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (207, '查看资料', NULL, 201, 99, 'admin.users.show', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (250, '内容管理', 'fa-list', 0, 95, NULL, 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (251, '内容列表', 'fa-list', 250, 1, 'admin.articles.index', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (252, '新增内容', NULL, 251, 99, 'admin.articles.create', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (253, '存储', NULL, 251, 99, 'admin.articles.store', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (254, '编辑内容', NULL, 251, 99, 'admin.articles.edit', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (255, '更新', NULL, 251, 99, 'admin.articles.update', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (256, '删除内容', NULL, 251, 99, 'admin.articles.destroy', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (257, '回收站', 'fa-trash', 250, 2, 'admin.articles.recycle', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (258, '还原', NULL, 257, 99, 'admin.articles.resume', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (259, '清空', NULL, 257, 99, 'admin.articles.delete', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (300, '分类管理', 'fa-list', 250, 3, 'admin.categories.index', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (301, '新增分类', NULL, 300, 99, 'admin.categories.create', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (302, '存储', NULL, 300, 99, 'admin.categories.stroe', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (303, '编辑分类', NULL, 300, 99, 'admin.categories.edit', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (304, '更新', NULL, 300, 99, 'admin.categories.update', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00'),
                (305, '删除分类', NULL, 300, 99, 'admin.categories.destroy', 1, 0, 1, '2018-05-05 00:00:00', '2018-05-05 00:00:00');";

        DB::insert($sql);

        Db::statement('alter table menus AUTO_INCREMENT=500;');
    }
}
