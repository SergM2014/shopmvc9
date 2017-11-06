@extends('layouts.master')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Main</a></li>
        <li class="active">About Us</li>
    </ol>




    <div class="row">

        <h2 class="text-center text-danger">About Us</h2>

        <div class="col-sm-2">

            @include('custom.partials.customLeftMenu')

        </div>

        <section class="col-sm-10">


            {!! $aboutUs !!}


        </section>
    </div>



    <script src="{{ mix('/js/app.js') }}"></script>

@endsection