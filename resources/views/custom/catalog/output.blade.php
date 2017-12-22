<div class="row">

    <h2 class="text-center text-danger">@lang('messages.catalog')</h2>

    <div class="col-sm-2">

        @include('custom.partials.customLeftMenu')

    </div>

    <section class="col-sm-10">

        @include('custom.partials.catalogDropdownMenu')

        @if($catalogResults->isNotEmpty())

            <?php foreach ($catalogResults as $item) : ?>

            <article class="catalog-item clearfix">

                <div class="row">
                    <div class="col-sm-3">

                        @if($item->images->isNotEmpty())

                            <img src="/uploads/productsImages/tn_{{ $item->images->first()['path'] }}" alt="" class="catalog-item-image left" >

                        @endif

                    </div>

                    <div class="col-sm-8 col-sm-offset-1">

                        <p class="text-danger"><span class="bg-danger">@lang('messages.author'): </span>{{ $item->author }}</p>

                        <p class="text-warning"><span class="bg-danger">@lang('messages.title'): </span> {{ $item->title }}</p>

                    </div>

                </div>

                <p class="text-info"><span class="bg-danger">@lang('messages.description'): </span>{{ $item->description }}</p>

                <p class="text-info"><span class="bg-danger">@lang('messages.manufacturer'): </span>{{ $item->manufacturer->title }}</p>

                @if($item->categories->isNotEmpty())
                    <p class="text-info"> <span class="bg-danger">@lang('messages.category'):</span>
                        @foreach ($item->categories as $category)
                            {{ $category->title }}
                        @endforeach
                    </p>

                @endif

                <p class="text-danger"><span class="bg-danger">@lang('messages.price'):</span> {{ $item->price }} $</p>

                <div>
                    <a href="/{{ App\Http\Middleware\LocaleMiddleware::printLink().'/product/'. $item->id }}" class="pull-right">@lang('messages.showProduct')</a>
                </div>

            </article>
            <?php endforeach; ?>

            <div class="text-center"> {{ $catalogResults->links() }}</div>

        @else
            <h1 class="bg-danger text-center">@lang('messages.nothingFound')</h1>
        @endif;



    </section>
</div>



<script src="{{ mix('/js/app.js') }}"></script>

