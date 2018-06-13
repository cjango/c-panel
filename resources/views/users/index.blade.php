@extends('Admin::layouts.app')

@section('title', 'users - index')

@section('css')
<style>
    .edit {
        cursor: pointer;
    }
</style>
@endsection

@push('script')
<script type="text/javascript">
    var $form = $('#showForm'), $id = '';
    $(".edit").on('click', function() {
        $id = $(this).data('id');
        $.get($(this).data('url'), function(data) {
            $('#actionPlace').empty().append(data)
        });
    });

    $('#add').on('click', function() {
        $.get("{{ route('admin.users.create') }}", function(data) {
            $('#actionPlace').empty().append(data)
        });
    });
</script>
@endpush

@section('content')
<div class="row">
    <div class="col-sm-8">
        <div class="ibox">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-12 m-b">
                        <button class="btn btn-sm btn-primary" type="button" id="add">
                            <i class="fa fa-plus"></i>
                            新增用户
                        </button>
                        <form action="{{ url()->current() }}" class="form-inline pull-right" method="get" accept-charset="utf-8">
                            <div class="input-group">
                                <input type="text" placeholder="用户名" name="username" class="input-sm form-control" value="{{ Request::get('username') }}">
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
                                <th width="50">编号</th>
                                <th width="100">用户名</th>
                                <th width="100">昵称</th>
                                <th></th>
                                <th width="50">登录</th>
                                <th width="135">注册时间</th>
                                <th width="135">上次登录</th>
                                <th width="120">上次登录IP</th>
                                <th width="50"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="edit" data-url="{{ route('admin.users.edit', $user) }}">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->info->nickname ?? '' }}</td>
                                <td></td>
                                <td>{{ $user->login }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->last_time }}</td>
                                <td>{{ $user->last_ip }}</td>
                                <td><a data-toggle="layer" data-height="280" href="{{ route('admin.users.show', $user) }}">资料</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4" id="actionPlace">
        @include('Admin::users.create')
    </div>
</div>
@endsection
