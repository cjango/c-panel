<?php

namespace cjango\CPanel\Controllers;

use cjango\CPanel\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $roles = Role::when($keyword, function ($query) use ($keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        })->withCount('users')->paginate();
        return view('CPanel::roles.index', compact('roles'));
    }

    public function create()
    {
        return view('CPanel::roles.create');
    }

    public function store(Request $request)
    {
        if (Role::create($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function edit(Role $role)
    {
        return view('CPanel::roles.edit', compact('role'));
    }

    public function update(Request $request, role $role)
    {
        if ($role->update($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function destroy(Role $role)
    {
        if ($role->users->count() > 0) {
            return $this->error('分组下有授权的用户，不允许直接删除');
        }

        if ($role->delete()) {
            return $this->success();
        } else {
            return $this->error();
        }
    }
}
