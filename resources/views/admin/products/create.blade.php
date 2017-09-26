@extends('layouts.admin')

@section('content')

    <h1 class="text-danger text-center">Create Product</h1>


    <section id="imagesContainer" class="clearfix">

        @if($images)

            @foreach($images as $image)

                @include('admin.products.drawImage')

            @endforeach

        @endif
    </section>

    <div>
        <img src="/img/nophoto.jpg" id="downloadImagePreview" class="img-thumbnail">
    </div>


    <div id="imageDownloadOutput" class="image-download__output">

    </div>

    <form enctype="multipart/form-data">

        <div class="form-group">

            <input type="file" id="file">
        </div>
        <button type="button" id="downloadImageBtn" class="image-download__btn hidden">Load</button>
        <button type="button" id="resetImageBtn" class="image-download__btn hidden">Delete</button>
    </form>

    <progress max="100" value="0" id="imageDownloadProgress"  class="image-download__progress hidden" ></progress>




    <form method="post" action="/admin/product/store">
        {{ csrf_field() }}

        <input type="hidden" name="imagesData" id="imagesData"value="{{ old('imagesData') }}">

        <div class="form-group @if($errors->has('author')) has-error @endif">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" name="author" placeholder="enter author" value="{{ old('author') }}">

            @if($errors->has('author'))
                <span class=" text-danger">{{ $errors->first('author') }}</span>
            @endif
        </div>


        <div class="form-group @if($errors->has('title')) has-error @endif">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="enter title" value="{{ old('title') }}">
            @if($errors->has('title'))
                <span class=" text-danger">{{ $errors->first('title') }}</span>
            @endif
        </div>

        <div class="form-group @if($errors->has('description')) has-error @endif">
            <label for="description">Description</label>
            <textarea class="form-control" rows="3" cols="10" id="description" name="description" placeholder="enter description">{{ old('description') }}</textarea>
            @if($errors->has('description'))
                <span class=" text-danger">{{ $errors->first('description') }}</span>
            @endif
        </div>

        <div class="form-group @if($errors->has('body')) has-error @endif">
            <label for="body">Body</label>
            <textarea class="form-control" rows="3" cols="10" id="body" name="body" placeholder="enter body">{{ old('body') }}</textarea>
            @if($errors->has('body'))
                <span class=" text-danger">{{ $errors->first('body') }}</span>
            @endif
        </div>

        <div class="form-group @if($errors->has('price')) has-error @endif">
            <label for="price">Price</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="enter price" value="{{ old('price') }}">
            @if($errors->has('price'))
                <span class=" text-danger">{{ $errors->first('price') }}</span>
            @endif
        </div>


        <div class="form-group @if($errors->has('categoryId')) has-error @endif">
            <label for="categoryId">Choose Category</label>
            <select multiple class="form-control" name="categoryId[]" id="categoryId">
                <?= $categoriesDropDownList ?>
            </select>
            @if($errors->has('categoryId'))
                <span class=" text-danger">{{ $errors->first('categoryId') }}</span>
            @endif
        </div>


        <div class="form-group">
            <label for="manufacturer">Manufacturer</label>
            <select  class="form-control" name="manufacturerId" id="manufacturerId">
                @foreach($manufacturers as $manufacturer)

                 <option value="{{ $manufacturer->id }}" <?= $manufacturer->id == old('manufacturerId')? 'selected': '' ?> >{{ $manufacturer->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">

                <button type="submit" class="btn btn-default pull-right">Create</button>

        </div>


    </form>



    <script src="{{ mix('js/admin/createProduct.js') }}"></script>



@endsection