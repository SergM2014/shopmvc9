<section  class="preview-product__container" >
    <h2 class="text-center text-danger">{{ $product->author }}</h2>
    <h3 class="text-center">{{ $product->title }}</h3>
    <h4 class="text-center">{{ $product->description }}</h4>

    <div class="product-preview-footer">

        <div class="product-preview__btn-container pull-right">
            <a class="btn btn-warning  product-preview-btn " href="/product/{{ $product->id }}" role="button">Go to the product</a>
        </div>
        <div class="product-preview__btn-container pull-right">
            <button type="button" id="productPreviewResetBtn" class="btn btn-danger  product-preview-btn ">Reset</button>
        </div>
    </div>
</section>