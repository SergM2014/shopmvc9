@extends('layouts.app')

@section('content')

    <h1 class="text-danger text-center">Create Product</h1>

    <form method="post" action="/admin/product/store">
        {{ csrf_field() }}

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

        <div class="form-group">
            <label for="manufacturer">Manufacturer</label>
            <select class="form-control" name="manufacturer_id" id="manufacturer_id">
                @foreach($manufacturers as $manufacturer)
                 <option value="{{ $manufacturer->id }}">{{ $manufacturer->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">

                <button type="submit" class="btn btn-default pull-right">Create</button>

        </div>


    </form>







@endsection