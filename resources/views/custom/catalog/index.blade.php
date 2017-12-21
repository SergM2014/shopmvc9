@extends('layouts.master')

@section('content')

    <ol class="breadcrumb">
        <li><a href="/{{ App\Http\Middleware\LocaleMiddleware::printLink() .'/' }}">@lang('messages.main')</a></li>
        <li class="active">@lang('messages.catalog')</li>
    </ol>

    @include('custom.catalog.output')

@endsection