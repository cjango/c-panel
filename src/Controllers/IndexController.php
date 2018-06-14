<?php

namespace cjango\CPanel\Controllers;

use Admin;
use cjango\CPanel\Models\Menu;
use cjango\CPanel\Requests\PasswordRequest;

class IndexController extends Controller
{

    public function index()
    {
        $adminMenus = Menu::adminShow();
        return view('CPanel::public.index', compact('adminMenus'));
    }

    public function dashboard()
    {
        return view('CPanel::public.dashboard');
    }

    public function password(PasswordRequest $request)
    {
        if ($request->isMethod('put')) {
            $user = Admin::user();

            $user->password = $request->repass;
            if ($user->save()) {
                return $this->success();
            } else {
                return $this->error();
            }
        } else {
            return view('CPanel::public.password');
        }
    }
}
