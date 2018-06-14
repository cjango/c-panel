<?php

namespace cjango\CPanel\Controllers;

use cjango\CPanel\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $admins  = Admin::when($keyword, function ($query) use ($keyword) {
            return $query->where('username', 'like', "%{$keyword}%");
        })->paginate();
        return view('CPanel::admins.index', compact('admins'));
    }

    public function create()
    {
        return view('CPanel::admins.create');
    }

    public function store(Request $request)
    {
        if (Admin::create($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function edit(Admin $admin)
    {
        return view('CPanel::Admins.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        if ($admin->update($request->all())) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function destroy(Admin $admin)
    {
        if ($admin->delete()) {
            return $this->success();
        } else {
            return $this->error();
        }
    }
}
