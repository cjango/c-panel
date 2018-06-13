@extends('Admin::layouts.app')

@section('title', 'roles - users')

@section('content')
<div class="row">
    <div class="col-sm-7">
        <div class="ibox">
            <div class="ibox-title">
                <h5><a href="{{ route('admin.roles.index' )}}"><i class="fa fa-angle-left"></i> 授权管理</a> 已授权用户</h5>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>UID</th>
                                <th>用户名</th>
                                <th>昵称</th>
                                <th>授权时间</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users  as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->info->nickname }}</td>
                                <td>{{ $user->pivot->created_at }}</td>
                                <td>
                                    <a class="ajax-get confirm" href="{{ route('admin.roles.remove', ['role' => $role, 'user' => $user]) }}" title="">移除</a>
                                </td>
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
    <div class="col-sm-5">
        <div class="ibox">
            <div class="ibox-title">
                <h5>搜索用户</h5>
            </div>
            <div class="ibox-content">
                <div class="m-b">
                    <form action="{{ url()->current() }}" method="post" accept-charset="utf-8" onkeydown="if (event.keyCode==13) return false;">
                        <div class="input-group">
                            <input type="text" placeholder="请输入UID/用户名" name="username" class="input-sm form-control" value="">
                            <span class="input-group-btn">
                                @csrf
                                <button type="button" class="btn btn-sm btn-primary">搜索</button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>UID</th>
                                <th>用户名</th>
                                <th>昵称</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="toAuthed">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $('button.btn-primary').on('click', function() {
        var $this = $(this);
        var $form = $this.parents('form');
        var query = $form.serialize();
        $.post('{{ url()->current() }}', query, function(data) {
            $('#toAuthed').empty();
            for (var i = 0; i < data.length; i++) {
                var url = '{{ route("admin.roles.auth", ["role" => $role, "user" => "****"]) }}';
                $('#toAuthed').append('<tr><td>' + data[i].id + '</td><td>' + data[i].username + '</td><td>' + data[i].info.nickname + '</td><td><a class="ajax-get confirm" href="' + url.replace('****', data[i].id) + '" title="">授权</a></td></tr>')
            };
        });
    });
</script>
@endpush
