@extends('master')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Main</a></li>
        <li><a href="{{ route('catalog') }}">Catalog</a></li>
        <li class="active">Product</li>
    </ol>




    <div class="row">

        <h2 class="text-center text-danger">Product</h2>

        <div class="col-sm-2">

            @include('custom.partials.customLeftMenu')

        </div>

        <section class="col-sm-10">

            @if($product->images->isNotEmpty())
                <div class="row">

                    @foreach($product->images as $image)

                        <div class="col-xs-6 col-md-3">
                            <a href="/uploads/productsImages/{{ $image->path }}" class="thumbnail" data-toggle="lightbox" >
                                <img src="/uploads/productsImages/{{ $image->path }}" alt="..." class="img-fluid">
                            </a>
                        </div>

                    @endforeach

                </div>

            @endif

            <div class="text-center text-danger">Author: {{ $product->author }}</div>
            <div class="text-center"><span class="text-info"> Title: </span> {{ $product->title }}</div>
                <div><span class="text-info"> Description: </span>{{ $product->description }}</div>
            <div>{{ $product->body }}</div>
            <div><span class="text-info"> Price: </span> {{ $product->price }} <span class="text-info"> hrn </span></div>
            <div><span class="text-info"> Manufacturer: </span> {{ $product->manufacturer->title }}</div>
            <div><span class="text-info"> Category: </span>
                @foreach ($product->categories as $category)

                {{ $category->title }}

                 @endforeach
            </div>
            <button class="btn btn-danger pull-right">Purchase</button>

        </section>
    </div>



    <script src="{{ mix('/js/productView.js') }}"></script>

@endsection