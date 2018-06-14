<?php
namespace cjango\CPanel\Controllers;

use Auth;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'username' => 'required|min:4',
                'password' => 'required|min:6',
                'verify'   => 'required|captcha',
            ], [
                'verify.captcha' => '验证码不正确',
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors()->first());
            }

            $certificates = [
                'username' => $request->username,
                'password' => $request->password,
            ];
            $remember = $request->remember ?: false;
            if (Auth::guard('cpanel')->attempt($certificates, $remember)) {
                return $this->success('登录成功', '/' . config('cpanel.route.prefix'));
            } else {
                return $this->error('用户名或密码错误');
            }
        } else {
            return view('CPanel::auth.login');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('cpanel')->logout();
        session()->flush();
        return $this->success('注销成功', '/' . config('cpanel.route.prefix') . '/auth/login');
    }
}
