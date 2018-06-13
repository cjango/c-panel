@extends('CPanel::layouts.app')

@section('title', 'roles - index')

@section('content')
<div class="row">
    <div class="ibox">
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-8 m-b">
                    <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="300" href="{{ route('CPanel.roles.create') }}">
                        <i class="fa fa-plus"></i>
                        新增角色
                    </a>
                </div>
                <div class="col-sm-4 m-b">
                    <form action="{{ url()->current() }}" method="get" accept-charset="utf-8">
                        <div class="input-group">
                            <input type="text" placeholder="请输入关键词" name="keyword" class="input-sm form-control" value="{{ Request::get('keyword') }}" />
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-primary">搜索</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="50">序号</th>
                            <th width="150">角色名称</th>
                            <th width="150">指定看守器</th>
                            <th></th>
                            <th width="135">创建时间</th>
                            <th width="135">更新时间</th>
                            <th width="80"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr class="edit" data-url="{{ route('CPanel.roles.edit', $role) }}">
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->guard_name }}</td>
                            <td></td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at }}</td>
                            <td>
                                <a data-toggle="layer" data-height="300" href="{{ route('CPanel.roles.edit', $role) }}">编辑</a>
                                <form action="{{ route('CPanel.roles.destroy', $role) }}" method="POST" style="display:inline">
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
                {{ $roles->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
