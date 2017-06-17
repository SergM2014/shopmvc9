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