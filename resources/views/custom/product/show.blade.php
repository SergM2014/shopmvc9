@extends('layouts.master')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/{{ App\Http\Middleware\LocaleMiddleware::printLink() .'/' }}">@lang('messages.main')</a></li>
        <li><a href="/{{ App\Http\Middleware\LocaleMiddleware::printLink() .'/catalog/all' }}">@lang('messages.catalog')</a></li>
        <li class="active">@lang('messages.product')</li>
    </ol>




    <div class="row">

        <h2 class="text-center text-danger">@lang('messages.product')</h2>

        <div class="col-sm-2">

            @include('custom.partials.customLeftMenu')

        </div>

        <section class="col-sm-10" id="productView">

            @if($product->images->isNotEmpty())
                <div class="row">

                    @foreach($product->images as $image)

                        @if (file_exists('/uploads/productsImages/{{ $image->path }}'))
                            <div class="col-xs-6 col-md-3">
                                <a href="/uploads/productsImages/{{ $image->path }}" class="thumbnail" data-toggle="lightbox" >
                                    <img src="/uploads/productsImages/{{ $image->path }}" alt="..." class="img-fluid" >
                                </a>
                            </div>
                        @endif

                    @endforeach

                </div>

            @endif

            <div class="text-center text-danger">@lang('messages.author'): {{ $product->author }}</div>
            <div class="text-center"><span class="text-info"> @lang('messages.title'): </span> {{ $product->title }}</div>
                <div><span class="text-info"> @lang('messages.description'): </span>{{ $product->description }}</div>
            <div>{{ $product->body }}</div>
            <div><span class="text-info"> @lang('messages.price'): </span> {{ $product->price }} <span class="text-info"> hrn </span></div>
            <div><span class="text-info"> @lang('messages.manufacturer'): </span> {{ $product->manufacturer->title }}</div>
            <div><span class="text-info"> @lang('messages.category'): </span>
                @foreach ($product->categories as $category)

                {{ $category->title }}

                 @endforeach
            </div>
                <form id="purchaseForm" class="clearfix">
                    {{--{{ csrf_field() }}--}}
                    <input type="hidden" name="_token"  value="{{ csrf_token() }}">
                    <input type="hidden" name="id"  value = "{{ $product->id }}">
                    <input type="hidden" name="price"  value="{{ $product->price }}">
                    <button id="purchase" class="btn btn-danger pull-right" @click.prevent="addToBusket">@lang('messages.purchase')</button>
                </form>

                <div class="clearfix">
                    <h2 class="text-center">@lang('messages.comments')</h2>
                    <ul class="list-group comment_list">

                        <?= $treeComments ?>

                    </ul>

                </div>

                <div class="clearfix" id="addCommentBlock">
                    <h4 class="text-center alert-danger">@lang('messages.addComment')</h4>
                    <div id="parentCommentBlock" class="parent_comment_block">

                    </div>

                    @include('custom.partials.addImage')

                    <form id="productCommentForm">

                        <input type="hidden" name="productId" id="productId" value="{{ $product->id }}">
                        <input type="hidden" name="parentId" id="parentId" value="0" >
                        <input type="hidden" name="image" id="image" >
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" v-model="email" placeholder="Email">
                            <span id="emailHelpBlock" class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label for="name">@lang('messages.name')</label>
                            <input type="text" class="form-control" id="name" v-model="name" placeholder="@lang('messages.name')">
                            <span id="nameHelpBlock" class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label for="comment">@lang('messages.comment')</label>
                            <textarea class="form-control" id="comment" placeholder="@lang('messages.comment')" v-model="comment" rows="5"></textarea>
                            <span id="commentHelpBlock" class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <p id="captchaImg" class="captcha_image">
                            @include('custom.partials.captcha')
                            </p>
                            <label for="name">@lang('messages.enterCaptcha')</label>
                            <input type="text" class="form-control" id="captcha" name="captcha" v-model="captcha" placeholder="@lang('messages.enterCaptcha')">
                            <span id="captchaHelpBlock" class="help-block"></span>
                        </div>


                        <button type="button" id="productCommentSubmit" class="btn btn-default" @click="makeComment">@lang('messages.submit')</button>
                    </form>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>


        </section>
    </div>



    <script src="{{ mix('/js/productView.js') }}"></script>

@endsection