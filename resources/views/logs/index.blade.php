@extends('CPanel::layouts.app')

@section('title', 'logs - index')

@section('content')
<div class="ibox">
    <div class="ibox-content">
        <div class="row">
            <form action="{{ url()->current() }}" class="form-inline pull-right" method="get" accept-charset="utf-8">
                <div class="input-group">
                    <input type="text" placeholder="请输入用户名" name="keyword" class="input-sm form-control" value="{{ Request::get('keyword') }}" />
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button>
                    </span>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">序号</th>
                        <th width="100">用户</th>
                        <th width="100">Path</th>
                        <th width="60">Method</th>
                        <th width="100">IP</th>
                        <th>Input</th>
                        <th width="135">创建时间</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $log->administrator->username }}</td>
                        <td>{{ $log->path }}</td>
                        <td>{!! $log->method !!}</td>
                        <td>{{ $log->ip }}</td>
                        <td>{{ $log->input }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-right">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
