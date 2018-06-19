@extends('CPanel::layouts.app')

@section('title', 'permissions - index')

@section('content')
<div class="row">
    <div class="ibox">
        <div class="ibox-content">
            <div class="row">
                <div class="col-sm-8 m-b">
                    <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="300" href="{{ route('CPanel.permissions.create') }}">
                        <i class="fa fa-plus"></i>
                        新增权限
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
                            <th width="150">权限标识</th>
                            <th width="150">指定看守器</th>
                            <th></th>
                            <th width="135">创建时间</th>
                            <th width="135">更新时间</th>
                            <th width="80"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                            <td></td>
                            <td>{{ $permission->created_at }}</td>
                            <td>{{ $permission->updated_at }}</td>
                            <td>
                                <a data-toggle="layer" data-height="300" href="{{ route('CPanel.permissions.edit', $permission) }}">编辑</a>
                                <form action="{{ route('CPanel.permissions.destroy', $permission) }}" method="POST" style="display:inline">
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
                {{ $permissions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
