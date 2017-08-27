@extends('layouts.app')

@section('content')

    <div class="table-responsive">
        <table class="table table-striped" id="allProductsTable">

            <tr>
                <th></th><th>Author</th><th>Title</th><th>Price</th><th>Manufacturer</th><th>Added At</th>
            </tr>
        @foreach($products as $product)
{{--{{ $product }}--}}
            <tr class="hover parent_tr" data-product-id="{{ $product->id }}">
                <td><?= ++$tableCounter ?></td>
                <td>{{ $product->author }}</td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->manufacturer->title }}</td>
                <td>{{ $product->created_at }}</td>
            </tr>

        @endforeach

        </table>
    </div>

    {{ $products->links() }}

    <script src="{{ mix('js/adminProducts.js') }}"></script>
@endsection