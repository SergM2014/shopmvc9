@extends('master')

@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Main</a></li>
        <li><a href="{{ route('catalog') }}">Catalog</a></li>
        <li class="active">Product</li>
    </ol>




    <div class="row">

        <h2 class="text-center text-danger">Product</h2>

        <div class="col-sm-2">

            @include('custom.partials.customLeftMenu')

        </div>

        <section class="col-sm-10">

            @if($product->images->isNotEmpty())
                <div class="row">

                    @foreach($product->images as $image)

                        <div class="col-xs-6 col-md-3">
                            <a href="/uploads/productsImages/{{ $image->path }}" class="thumbnail" data-toggle="lightbox" >
                                <img src="/uploads/productsImages/{{ $image->path }}" alt="..." class="img-fluid">
                            </a>
                        </div>

                    @endforeach

                </div>

            @endif

            <div class="text-center text-danger">Author: {{ $product->author }}</div>
            <div class="text-center"><span class="text-info"> Title: </span> {{ $product->title }}</div>
                <div><span class="text-info"> Description: </span>{{ $product->description }}</div>
            <div>{{ $product->body }}</div>
            <div><span class="text-info"> Price: </span> {{ $product->price }} <span class="text-info"> hrn </span></div>
            <div><span class="text-info"> Manufacturer: </span> {{ $product->manufacturer->title }}</div>
            <div><span class="text-info"> Category: </span>
                @foreach ($product->categories as $category)

                {{ $category->title }}

                 @endforeach
            </div>
                <form id="purchaseForm" class="clearfix">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value = "{{ $product->id }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <button id="purchase" class="btn btn-danger pull-right">Purchase</button>
                </form>

                <div class="clearfix">
                    <h2 class="text-center">Comments</h2>
                    <ul class="list-group">

                        <?= $treeComments ?>

                    </ul>

                </div>

                <div class="clearfix" id="addCommentBlock">
                    <h4 class="text-center alert-danger">Add Comment</h4>

                    @include('custom.partials.addImage')

                    <form id="productComment">

                        <input type="hidden" name="productId" id="productId" value="{{ $product->id }}">
                        <input type="hidden" name="parentId" id="parentId" value="0" >
                        <input type="hidden" name="image" id="image" >

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Email">
                            <span id="emailHelpBlock" class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Name">
                            <span id="nameHelpBlock" class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea class="form-control" id="comment" placeholder="comment" rows="5"></textarea>
                            <span id="commentHelpBlock" class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <p id="captchaImg" class="captcha_image"><?=  \Captcha::img() ?></p>
                            <label for="name">enter captcha</label>
                            <input type="text" class="form-control" id="captcha" name="captcha" placeholder="enter captcha">
                            <span id="captchaHelpBlock" class="help-block"></span>
                        </div>


                        <button type="button" id="productCommentSubmit" class="btn btn-default">Submit</button>
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