<h3>@lang('messages.categories')</h3>
<ul class='left-menu'>
    {!! $leftCatalogMenu !!}
</ul>


<h3>@lang('messages.manufacturers')</h3>
<ul class="left-menu">
    @foreach( $manufacturers as $manufacturer)

        <li><a href="/{{ App\Http\Middleware\LocaleMiddleware::printLink() .'/catalog/manufacturer/'. $manufacturer->eng_translit_title }}">{{ $manufacturer->title }}</a></li>

    @endforeach
</ul>