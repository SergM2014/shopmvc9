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

            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Order By
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="{{ url()->current().'/AZ'  }}">A-Z</a></li>
                    <li><a href="{{ url()->current().'/ZA'  }}">Z-A</a></li>
                    <li><a href="{{ url()->current().'/cheap_first'  }}">Cheap first</a></li>
                    <li><a href="{{ url()->current().'/expensive_first'  }}">Expansive first</a></li>
                    <li><a href="{{ url()->current().'/new_first'  }}">New first</a></li>
                    <li><a href="{{ url()->current().'/old_first'  }}">Old first</a></li>

                </ul>
            </div>

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



    <script src="{{ mix('/js/app.js') }}"></script>

@endsection