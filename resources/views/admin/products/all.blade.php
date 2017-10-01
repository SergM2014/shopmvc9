@extends('layouts.admin')

@section('content')

    <div class="add-btn__container clearfix">
        <a class="btn btn-success pull-right add-product-btn" href="/admin/products/create" role="button">Add Product</a>
    </div>
    <div class="table-responsive" id="productsTableContainer">

        <modal-background v-if="showModalBackground"></modal-background>
        <popup-menu v-show="showPopupMenu"></popup-menu>

        <table class="table table-striped" id="allProductsTable" @click="drawMenu">
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
        <a class="btn btn-success pull-right add-product-btn" href="/admin/products/create" role="button">Add Product</a>
    </div>
    {{ $products->links() }}

    <script src="{{ mix('js/admin/products.js') }}"></script>
@endsection