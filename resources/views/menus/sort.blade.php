@extends('CPanel::layouts.app')

@section('title', 'menus - sort')

@section('content')
<div class="dd">
    <ol class="dd-list">
        @foreach ($list as $menu)
        <li class="dd-item" data-id="{{ $menu->id }}">
            <div class="dd-handle">
                <span class="label label-info"><i class="fa {{ $menu->icon }}"></i></span>
                {{ $menu->title }}
            </div>
        </li>
        @endforeach
    </ol>
    <button class="btn btn-primary" disabled id="doAction" type="button">保存排序</button>
</div>
@endsection

@push('script')
<script src="{{ admin_assets('js/plugins/nestable/jquery.nestable.js') }}"></script>
<script type="text/javascript">
    var sort = '';
    $('.dd').nestable({
        maxDepth:1
    }).on('change', function(e) {
        sort = JSON.stringify($('.dd').nestable('serialize'));
        $('#doAction').removeAttr('disabled');
    });

    $('#doAction').on('click', function() {
        $.post('{{ url()->current() }}', {sort, _token: '{{ csrf_token() }}'}, function(data) {
            var prt = parent;
            if (data.code) {
                var index = prt.layer.getFrameIndex(window.name);
                prt.layer.close(index);
                prt.updateAlert(data.msg, data.code, function() {
                    prt.location.reload();
                });
            } else {
                prt.updateAlert(data.msg, data.code);
            }
        });
    });
</script>
@endpush
