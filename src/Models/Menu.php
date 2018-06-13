<?php

namespace cjango\CPanel\Models;

use Auth;
use cjango\CPanel\Extensions\Tree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{

    protected $table = 'admin_menus';

    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    /**
     * 后台菜单展示
     * @return [type] [description]
     */
    public static function adminShow()
    {
        $administrator = Auth::guard('cpanel')->id() != 1;

        $list = self::when($administrator, function ($query) {
            $ruleIds = [];
            $rules   = Auth::guard('admin')->user()->roles()->pluck('rules');
            foreach ($rules as $rule) {
                $ruleIds = array_merge($ruleIds, $rule);
            }
            $ruleIds = array_unique($ruleIds);
            return $query->whereIn('id', $ruleIds);
        })->orderBy('sort', 'asc')->get()->toArray();
        return Tree::list2tree($list);
    }

    public static function treeJson()
    {
        $list = self::select('id', 'parent_id', 'title as text', DB::raw('concat("fa", " ", icon) as icon'))->orderBy('sort', 'asc')->get()->toArray();
        return json_encode(Tree::list2tree($list, 'id', 'parent_id', 'nodes'), JSON_UNESCAPED_UNICODE);
    }

    public static function treeShow($id = 0)
    {
        $menus = self::when($id, function ($query) use ($id) {
            return $query->where('id', '<>', $id);
        })->orderBy('sort', 'asc')->get()->toArray();

        $menus = Tree::toFormatTree($menus);

        $menus = array_merge([0 => ['id' => 0, 'title_show' => '顶级菜单']], $menus);
        return $menus;
    }
}
