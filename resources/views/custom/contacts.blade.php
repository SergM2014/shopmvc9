@extends('master')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Main</a></li>
        <li class="active">Downloads</li>
    </ol>




    <div class="row">

        <h2 class="text-center text-danger">Contacts</h2>

        <div class="col-sm-2">

            @include('custom.partials.customLeftMenu')

        </div>

        <section class="col-sm-10">


            {!! $contacts !!}


        </section>
    </div>



    <script src="{{ mix('/js/app.js') }}"></script>

@endsection