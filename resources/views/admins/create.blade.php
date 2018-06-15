@extends('CPanel::layouts.app')

@section('title', 'admins - create')

@section('content')
<form class="form-horizontal" method="post" action="{{ route('CPanel.admins.store') }}">
    <div class="form-group">
        <label class="col-xs-3 control-label">用户名</label>
        <div class="col-xs-8">
            <input type="text" placeholder="登录用户名" name="username" class="form-control" value="" autocomplete="off" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">登录密码</label>
        <div class="col-xs-8">
            <input type="text" placeholder="登录密码" name="password" class="form-control" value="" autocomplete="off" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">用户昵称</label>
        <div class="col-xs-8">
            <input type="text" placeholder="用户昵称" name="nickname" class="form-control" value="" autocomplete="off" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-8">
            @csrf
            <button class="btn btn-primary ajax-post" type="button">新增用户</button>
        </div>
    </div>
</form>
@endsection
