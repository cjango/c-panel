<?php

namespace cjango\CPanel\Controllers;

use cjango\CPanel\Models\Role;
use cjango\CPanel\Requests\RoleRequest;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $roles = Role::when($keyword, function ($query) use ($keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        })->paginate();
        return view('CPanel::roles.index', compact('roles'));
    }

    public function create()
    {
        $guards = array_keys(config('auth.guards'));
        return view('CPanel::roles.create', compact('guards'));
    }

    public function store(RoleRequest $request)
    {
        if (Role::create($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function edit(Role $role)
    {
        $guards = array_keys(config('auth.guards'));
        return view('CPanel::roles.edit', compact('guards', 'role'));
    }

    public function update(RoleRequest $request, role $role)
    {
        if ($role->update($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function destroy(Role $role)
    {
        if ($role->delete()) {
            return $this->success();
        } else {
            return $this->error();
        }
    }
}
