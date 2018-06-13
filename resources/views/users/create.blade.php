<div class="ibox">
    <div class="ibox-title">
        <h5>新增用户</h5>
    </div>
    <div class="ibox-content">
        <form class="form-horizontal" method="post" action="{{ route('admin.users.store') }}" id="showForm" autocomplete="off">
            <div class="form-group">
                <label class="col-sm-3 control-label">用户名</label>
                <div class="col-sm-8">
                    <input type="text" placeholder="用户名" name="username" class="form-control" autocomplete="off" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">登录密码</label>
                <div class="col-sm-8">
                    <input type="password" placeholder="登录密码" name="password" class="form-control" autocomplete="off" value="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-8">
                    @csrf
                    <button class="btn btn-primary ajax-post" type="button">新增用户</button>
                </div>
            </div>
        </form>
    </div>
</div>
