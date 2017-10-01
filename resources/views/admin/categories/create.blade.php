@extends('layouts.admin')

@section('content')


    <div class="center-block flex-centered">

        <form action="/admin/categories" method="POST" class="auto-margin" >


        <h1 class="bg-danger text-center">Create Category</h1>

            {{ csrf_field() }}
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
                <input type="text" class="form-control" id="title" name="title" placeholder="Put a title">
                @if($errors->has('title'))
                    <span class=" text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-default">Create</button>

        </form>
    </div>


    {{--<script src="{{ mix('js/admin/categories.js') }}"></script>--}}
@endsection