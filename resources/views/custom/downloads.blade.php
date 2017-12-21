@extends('layouts.master')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/{{ App\Http\Middleware\LocaleMiddleware::printLink() .'/' }}">@lang('messages.main')</a></li>
        <li class="active">@lang('messages.downloads')</li>
    </ol>




    <div class="row">

        <h2 class="text-center text-danger">@lang('messages.downloads')</h2>

        <div class="col-sm-2">

            @include('custom.partials.customLeftMenu')

        </div>

        <section class="col-sm-10">


            {!! $downloads !!}


        </section>
    </div>



    <script src="{{ mix('/js/app.js') }}"></script>

@endsection