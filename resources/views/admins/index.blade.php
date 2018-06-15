@extends('CPanel::layouts.app')

@section('title', 'admins - index')

@section('content')
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-4 m-b">
                <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="300" href="{{ route('CPanel.admins.create') }}">
                    <i class="fa fa-plus"></i>
                    新增用户
                </a>
            </div>
            <div class="col-sm-8 m-b">
                <form action="{{ url()->current() }}" class="form-inline pull-right" method="get" accept-charset="utf-8">
                    <div class="input-group">
                        <input type="text" placeholder="请输入用户名" name="keyword" class="input-sm form-control" value="{{ Request::get('keyword') }}" />
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-primary"> 搜索</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">编号</th>
                        <th width="100">用户名</th>
                        <th width="100">昵称</th>
                        <th></th>
                        <th width="135">注册时间</th>
                        <th width="50">登录</th>
                        <th width="120">上次登录IP</th>
                        <th width="135">上次登录时间</th>
                        <th width="80"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->id }}</td>
                        <td>{{ $admin->username }}</td>
                        <td>{{ $admin->nickname }}</td>
                        <td></td>
                        <td>{{ $admin->created_at }}</td>
                        <td>{{ $admin->logins_count }}</td>
                        <td>{{ $admin->lastLogin->login_ip }}</td>
                        <td>{{ $admin->lastLogin->created_at }}</td>
                        <td>
                            <a data-toggle="layer" data-height="300" href="{{ route('CPanel.admins.edit', $admin) }}" title="编辑用户">编辑</a>
                            <form action="{{ route('CPanel.admins.destroy', $admin) }}" method="POST" style="display:inline">
                                <a href="javascript:void(0);" class="ajax-post confirm">
                                    删除
                                </a>
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-right">
            {{ $admins->links() }}
        </div>
    </div>
</div>
@endsection
