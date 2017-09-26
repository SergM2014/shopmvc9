@extends('layouts.admin')

@section('content')

    <div class="add-btn__container clearfix">
        <a class="btn btn-success pull-right add-product-btn" href="/admin/product/create" role="button">Add Product</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped" id="allProductsTable">

            <tr>
                <th></th><th>Author</th><th>Title</th><th>Price</th><th>Manufacturer</th><th>Added At</th>
            </tr>
        @foreach($products as $product)

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
    <div class="add-btn__container clearfix">
        <a class="btn btn-success pull-right add-product-btn" href="/admin/product/create" role="button">Add Product</a>
    </div>
    {{ $products->links() }}

    <script src="{{ mix('js/admin/products.js') }}"></script>
@endsection