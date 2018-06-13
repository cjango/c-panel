@extends('Admin::layouts.app')

@section('title', 'users - show')

@section('content')
<div class="contact-box" style="margin-bottom:0">
    <div class="col-xs-4">
        <div class="text-center">
            <img alt="image" class="img-circle m-t-xs img-responsive" src="{{ $user->info->avatar ?? '' }}">
            <div class="m-t-md font-bold">{{ $user->username }}</div>
        </div>
    </div>
    <div class="col-xs-8">
        <h3><strong>{{ $user->info->nickname ?? '' }}</strong></h3>
        <address>
            <strong>Sex: {{ $user->info->sex_text ?? '' }}</strong><br>
            <abbr title="Phone">Email:</abbr> {{ $user->info->email ?? '' }}
        </address>
    </div>
    <div class="clearfix"></div>
</div>
@endsection
