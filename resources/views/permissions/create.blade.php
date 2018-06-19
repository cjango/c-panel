@extends('CPanel::layouts.app')

@section('title', 'permissions - create')

@section('content')
<form class="form-horizontal" method="post" action="{{ route('CPanel.permissions.store' ) }}">
    <div class="form-group">
        <label class="col-xs-3 control-label">权限标识</label>
        <div class="col-xs-8">
            <input type="text" placeholder="权限标识" name="name" class="form-control" value="" autocomplete="off" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">指定看守器</label>
        <div class="col-xs-8">
            <select name="guard_name" class="form-control">
                @foreach ($guards as $guard)
                <option value="{{ $guard }}">{{ $guard }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-8">
            @csrf
            <button class="btn btn-primary ajax-post" type="button">新增角色</button>
        </div>
    </div>
</form>
@endsection
