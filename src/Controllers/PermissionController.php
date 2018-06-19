<?php

namespace cjango\CPanel\Controllers;

use cjango\CPanel\Models\Permission;
use cjango\CPanel\Requests\PermissionRequest;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $permissions = Permission::when($keyword, function ($query) use ($keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        })->paginate();
        return view('CPanel::permissions.index', compact('permissions'));
    }

    public function create()
    {
        $guards = array_keys(config('auth.guards'));
        return view('CPanel::permissions.create', compact('guards'));
    }

    public function store(PermissionRequest $request)
    {
        if (Permission::create($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function edit(Permission $permission)
    {
        $guards = array_keys(config('auth.guards'));
        return view('CPanel::permissions.edit', compact('guards', 'permission'));
    }

    public function update(PermissionRequest $request, role $permission)
    {
        if ($permissions->update($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function destroy(Permission $permissions)
    {
        if ($permissions->delete()) {
            return $this->success();
        } else {
            return $this->error();
        }
    }
}
