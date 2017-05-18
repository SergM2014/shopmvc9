@extends('master')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Main</a></li>
        <li class="active">About Us</li>
    </ol>




    <div class="row">

        <h2 class="text-center text-danger">About Us</h2>

        <div class="col-sm-2">
            <h3>Categories</h3>
            <ul class='left-menu'>
                {!! $leftCatalogMenu !!}
            </ul>


            <h3>Manufacturers</h3>
            <ul class="left-menu">
                @foreach( $manufacturers as $manufacturer)

                    <li><a href="/catalog/manufacturer/{{ $manufacturer->eng_translit_title }}">{{ $manufacturer->title }}</a></li>

                @endforeach
            </ul>

        </div>

        <section class="col-sm-10">


            {!! $aboutUs !!}


        </section>
    </div>



    <script src="{{ mix('/js/app.js') }}"></script>

@endsection