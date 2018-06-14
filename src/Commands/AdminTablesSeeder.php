<?php

namespace cjango\CPanel\Commands;

use cjango\CPanel\Models\Admin;
use cjango\CPanel\Models\Menu;
use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        Admin::truncate();
        Admin::create([
            'username' => 'root',
            'password' => '111111',
            'nickname' => 'Rooter',
        ]);

        // add default menus.
        Menu::truncate();
        Menu::insert([
            [
                'parent_id' => 0,
                'title'     => '系统管理',
                'icon'      => 'fa-cogs',
                'sort'      => 99,
                'uri'       => null,
            ],
            [
                'parent_id' => 1,
                'title'     => '用户管理',
                'icon'      => 'fa-user',
                'sort'      => 1,
                'uri'       => 'admins',
            ],
            [
                'parent_id' => 1,
                'title'     => '权限管理',
                'icon'      => 'fa-group',
                'sort'      => 2,
                'uri'       => 'roles',
            ],
            [
                'parent_id' => 1,
                'title'     => '菜单管理',
                'icon'      => 'fa-bars',
                'sort'      => 3,
                'uri'       => 'menus',
            ],
            [
                'parent_id' => 1,
                'title'     => '系统日志',
                'icon'      => 'fa-list',
                'sort'      => 4,
                'uri'       => 'logs',
            ],
        ]);
    }
}
