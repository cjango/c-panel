<div class="ibox">
    <div class="ibox-title">
        <h5>编辑用户</h5>
    </div>
    <div class="ibox-content">
        <form class="form-horizontal" method="post" action="{{ route('admin.users.update', $user) }}" id="showForm" autocomplete="off">
            <div class="form-group">
                <label class="col-sm-3 control-label">用户名</label>
                <div class="col-sm-8">
                    <input type="text" placeholder="用户名" readonly="readonly" class="form-control" autocomplete="off" value="{{ $user->username }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">登录密码</label>
                <div class="col-sm-8">
                    <input type="password" placeholder="如若为空，则不修改密码" name="password" autocomplete="off" class="form-control" value="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-8">
                    @csrf
                    @method('put')
                    <button class="btn btn-primary ajax-post" type="button">保存编辑</button>
                    <a class="btn btn-danger pull-right" href="{{ route('admin.users.destroy', $user) }}">删除用户</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $('.btn-danger').on('click', function(event) {
        event.preventDefault();
        swal({
            title: "您确定要删除这条用户吗",
            text: "删除后将无法恢复，请谨慎操作！",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "是的，我要删除！",
            cancelButtonText: "让我再考虑一下…",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function() {
            $.post(event.target.href, {_method:'DELETE', _token: "{{ csrf_token() }}"}, function(res) {
                if (res.code) {
                    updateAlert(res.msg, true, function() {
                        location.reload();
                    });
                } else {
                    updateAlert(res.msg, false);
                }
            });
        })
    });
</script>
