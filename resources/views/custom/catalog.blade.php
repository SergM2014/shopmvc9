@extends('master')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Main</a></li>
        <li class="active">Catalog</li>
    </ol>




    <div class="row">

        <h2 class="text-center text-danger">Catalog</h2>

        <div class="col-sm-2">
            <h3>Categories</h3>
            <ul class='left-menu'>
                {!! $leftCatalogMenu !!}
            </ul>


            <h3>Manufacturers</h3>
            <ul class="left-menu">
                @foreach( $manufacturers as $manufacturer)

                    <li><a href="/manufacturer/{{ $manufacturer->eng_translit_title }}">{{ $manufacturer->title }}</a></li>

                @endforeach
            </ul>

        </div>

        <section class="col-sm-10">

            @if($catalogResults)

            <?php foreach ($catalogResults as $item) : ?>

            <article class="catalog-item clearfix">

                <div class="row">
                    <div class="col-sm-3">
                        @if($item->images->isNotEmpty())

                            <img src="/uploads/productsImages/tn_{{ $item->images->first()['path'] }}" alt="" class="catalog-item-image left" >

                        @endif
                    </div>

                    <div class="col-sm-8 col-sm-offset-1">

                        <p class="text-danger"><span class="bg-danger">Author: </span>{{ $item->author }}</p>

                        <p class="text-warning"><span class="bg-danger">Title: </span> {{ $item->title }}</p>

                    </div>
                </div>
                <p class="text-info"><span class="bg-danger">Description: </span>{{ $item->description }}</p>



                <p class="text-info"><span class="bg-danger">Manufacturer: </span>{{ $item->manufacturer->title }}</p>

                   @if($item->categories->isNotEmpty())
                    <p class="text-info"> <span class="bg-danger">Category:</span>
                       @foreach ($item->categories as $category)
                        {{ $category->title }}
                        @endforeach
                    </p>

                   @endif

                <p class="text-danger"><span class="bg-danger">Price:</span> {{ $item->price }} $</p>

                    <div>
                        <a href="/product/{{ $item->id }}" class="pull-right">Show product</a>
                    </div>

            </article>
            <?php endforeach; ?>


                <div class="text-center"> {{ $catalogResults->links() }}</div>

            @else
                  <h1 class="bg-danger text-center">Noting is found. Try another query ></h1>
            @endif;



        </section>
    </div>





@endsection