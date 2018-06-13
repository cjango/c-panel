@extends('CPanel::layouts.app')

@section('content')
<form class="form-horizontal" method="post" action="{{ url()->current() }}">
    <div class="form-group">
        <label class="col-xs-3 control-label">原始密码</label>
        <div class="col-xs-8">
            <input type="password" class="form-control" value="" name="oldpass">
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">新的密码</label>
        <div class="col-xs-8">
            <input type="password" class="form-control" value="" name="newpass">
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">重复密码</label>
        <div class="col-xs-8">
            <input type="password" class="form-control" value="" name="repass">
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-8">
            @csrf
            @method('PUT')
            <button class="btn btn-primary btn-block ajax-post" type="button">
                <i class="icon icon-check"></i> 确认修改
            </button>
        </div>
    </div>
</form>
@endsection
