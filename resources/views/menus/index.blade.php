@extends('CPanel::layouts.app')

@section('title', 'menu - index')

@section('content')
<div class="row">
    <div class="col-sm-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>菜单地图</h5>
            </div>
            <div class="ibox-content">
                <div id="tree"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="ibox">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-8 m-b">
                        @if (Request::get('parent_id') != 0)
                        <a class="btn btn-sm btn-white" href="{{ route('CPanel.menus.index') }}"><i class="fa fa-angle-left"></i> 返回</a>
                        @endif
                        <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="510" href="{{ route('CPanel.menus.create', ['parent_id' => Request::get('parent_id')]) }}">
                            <i class="fa fa-plus"></i>
                            新增菜单
                        </a>

                        <a class="btn btn-sm btn-primary" data-toggle="layer" data-height="510" href="{{ route('CPanel.menus.sort', ['parent_id' => Request::get('parent_id', 0)]) }}">
                            <i class="fa fa-sort-amount-asc"></i>
                            菜单排序
                        </a>
                    </div>
                    <div class="col-sm-4 m-b">
                        <form action="{{ url()->current() }}" class="form-inline pull-right" method="get" accept-charset="utf-8">
                            <div class="input-group">
                                <input type="text" placeholder="请输入关键词" name="keyword" class="input-sm form-control" value="{{ Request::get('keyword') }}" />
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
                                <th width="45">序号</th>
                                <th width="120">菜单名称</th>
                                <th width="45">图标</th>
                                <th width="45">排序</th>
                                <th>连接地址</th>
                                <th width="135">创建时间</th>
                                <th width="80">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{ route('CPanel.menus.index', ['parent_id' => $menu->id]) }}" title="{{ $menu->title }}">{{ $menu->title }}</a></td>
                                <td><i class="fa {{ $menu->icon }}"></i></td>
                                <td>{{ $menu->sort }}</td>
                                <td>{{ $menu->uri }}</td>
                                <td>{{ $menu->created_at }}</td>
                                <td>
                                    <a href="{{ route('CPanel.menus.edit', $menu) }}" data-toggle="layer" data-height="510" class="edit" title="编辑菜单">编辑</a>
                                    <form action="{{ route('CPanel.menus.destroy', $menu) }}" method="POST" style="display:inline">
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
                    {{ $menus->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('assets/cpanel/js/plugins/treeview/bootstrap-treeview.js') }}"></script>
<script type="text/javascript">
    $('#tree').treeview({data: {!! $menuTree !!}});
</script>
@endpush
