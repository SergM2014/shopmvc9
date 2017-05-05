@extends('master')

@section('content')
    <ol class="breadcrumb">

        <li class="active">Main</li>
    </ol>




    <div class="row">

        <div class="col-sm-2">
            <ul class='left-menu'>
                {!! $leftCatalogMenu !!}
            </ul>
        </div>

        <section class="col-sm-10">

            <h2 class="text-center">Catalog</h2>







            @if($catalogResults)

            <?php foreach ($catalogResults as $item) : ?>

            <article class="content-zone__item clearfix">


                <div class="content-zone__item-output">

                    @if($item->images)

                        {{ $item->images->first()['path'] }}

                    @endif
                    <br>
                        <p>{{ $item->author }}</p>
                        <p>{{ $item->title }}</p>
                        <p>{{ $item->description }}</p>
                        <p>{{ $item->body }}</p>
                        <p>{{ $item->price }}</p>
                    <br>
                    {{ $item->manufacturer->title }}
                    <br>
                   @if($item->categories)

                       @foreach ($item->categories as $category)
                           {{ $category->title  }}
                        @endforeach

                   @endif


                </div>
                <br>
                <br>

            </article>
            <?php endforeach; ?>

                {{ $catalogResults->links() }}

            @else

            <h2 class="notice"><?= 'Noting is found' ?></h2>

            @endif;



        </section>
    </div>





@endsection