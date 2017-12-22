<section  class="preview-product__container" >
    <h2 class="text-center text-danger">{{ $product->author }}</h2>
    <h3 class="text-center">{{ $product->title }}</h3>
    <h4 class="text-center">{{ $product->description }}</h4>

    <div class="product-preview-footer">

        <div class="product-preview__btn-container pull-right">
            <a class="btn btn-warning  product-preview-btn " href="/product/{{ $product->id }}" role="button">@lang('messages.goToProduct')</a>
        </div>
        <div class="product-preview__btn-container pull-right">
            <button type="button" id="productPreviewResetBtn" class="btn btn-danger  product-preview-btn ">@lang('messages.reset')</button>
        </div>
    </div>
</section>