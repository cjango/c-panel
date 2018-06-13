@extends('Admin::layouts.app')

@section('title', 'roles - menus')

@section('content')
<div class="ibox">
    <form action="{{ url()->current() }}" method="post" accept-charset="utf-8">
        <div class="ibox-content">
            <div class="m-b-sm">
                <a class="btn btn-white" href="{{ route('admin.roles.index' )}}"><i class="fa fa-angle-left"></i> 返回</a>
                @csrf
                <button class="btn btn-primary ajax-post" type="button">保存授权</button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        @foreach ($menus as $menu)
                        <tr class="main_{{ $menu->id }}">
                            <td width="200" rowspan="{{ $menu->children->count() ?: 1 }}">
                                <input name="rules[]" class="i-checks" type="checkbox" value="{{ $menu->id }}" data-id="{{ $menu->id }}" @if (in_array($menu->id, $role->rules ?? [])) checked @endif />{{ $menu->title }}
                            </td>
                            @if ($menu->children()->count() == 0)
                            <td></td>
                            <td></td>
                            @endif

                            @foreach ($menu->children as $row => $children)
                            @if ($row > 0)
                            <tr class="main_{{ $menu->id }}">
                                @endif
                                <td width="200">
                                    <input name="rules[]" class="i-checks" type="checkbox" value="{{ $children->id }}" data-id="{{ $children->id }}" @if (in_array($menu->id, $role->rules ?? [])) checked @endif /> {{ $children->title }}
                                </td>
                                <td class="left two_{{ $children->id }}">
                                    @foreach ($children->children as $son)
                                    <input name="rules[]" class="i-checks" type="checkbox" value="{{ $son->id }}" @if (in_array($son->id, $role->rules ?? [])) checked @endif /> {{ $son->title }}
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </tr>
            </div>
        </div>
    </form>
</div>
@endsection

@push('script')
<link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/iCheck/custom.css') }}" />
<script src="{{ asset('assets/admin/js/plugins/iCheck/icheck.min.js') }}"></script>
<script type="text/javascript">
    $(".i-checks").iCheck({
        checkboxClass: "icheckbox_square-green"
    });

    $('input[type="checkbox"]').on('ifChecked', function() {
        var $this = $(this);
        var id    = $this.attr('data-id');
        $(".main_" + id).find('input').iCheck('check')
        $(".two_" + id).find('input').iCheck('check')
    });

    $('input[type="checkbox"]').on('ifUnchecked', function() {
        var $this = $(this);
        var id    = $this.attr('data-id');
        $(".main_" + id).find('input').iCheck('uncheck')
        $(".two_" + id).find('input').iCheck('uncheck')
    });
</script>
@endpush
