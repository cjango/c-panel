@extends('CPanel::layouts.app')

@section('title', 'menu - edit')

@section('css')
<link rel="stylesheet" href="{{ admin_assets('css/plugins/iCheck/custom.css') }}" />
@endsection

@push('script')
<script src="{{ admin_assets('js/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green"});
</script>
@endpush

@section('content')
<form method="post" action="{{ route('CPanel.menus.update', $menu) }}" class="form-horizontal">
    <div class="form-group">
        <label class="col-xs-3 control-label">菜单名称</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="title" value="{{ $menu->title }}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">菜单图标</label>
        <div class="col-xs-4">
            <input type="text" class="form-control" placeholder="" name="icon" value="{{ $menu->icon }}" />
        </div>
        <div class="col-xs-4">
            <i class="fa {{ $menu->icon }}"></i>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">上级菜单</label>
        <div class="col-xs-8">
            <select class="form-control" name="parent_id">
                @foreach ($topMenus as $top)
                <option @if ($top['id'] ==  $menu->parent_id) selected @endif value="{{ $top['id'] }}">{!! $top['title_show'] !!}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">菜单排序</label>
        <div class="col-xs-4">
            <input type="text" class="form-control" placeholder="" name="sort" value="{{ $menu->sort }}" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-xs-3 control-label">连接地址</label>
        <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="" name="uri" value="{{ $menu->uri }}" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-4 col-xs-offset-3">
            @csrf
            @method('put')
            <button class="btn btn-primary ajax-post" type="button">保存菜单</button>
        </div>
    </div>
</form>
@endsection
