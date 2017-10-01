@extends('layouts.admin')

@section('content')


    <div class="center-block flex-centered">

        <form action="/admin/categories" method="POST" class="auto-margin" >


        <h1 class="bg-danger text-center">Edit Category</h1>

            {{ method_field('PUT') }}

            {{ csrf_field() }}

            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="form-group">
                <label for="parentId" class="text-warning">Choose Parent Category</label>
                <br>
                <select name="parentId" class="form-control" >
                    <option value="0">Designate as start category</option>
                    {!!  $dropDownList !!}
                </select>
            </div>

            <div class="form-group">
                <label for="title" class="text-warning">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Put a title"
                       value="{{ old('_token')? old('title'): $category->title }}">
                @if($errors->has('title'))
                    <span class=" text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-default">update</button>

        </form>
    </div>


    {{--<script src="{{ mix('js/admin/categories.js') }}"></script>--}}
@endsection