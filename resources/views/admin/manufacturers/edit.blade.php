@extends('layouts.admin')

@section('content')


    <div class="center-block flex-centered">

        <form action="/admin/manufacturers/<?= $manufacturer->id ?>" method="POST" class="auto-margin" >


        <h1 class="bg-danger text-center">Edit Manufacturer</h1>

            {{ method_field('PUT') }}

            {{ csrf_field() }}

            <input type="hidden" name="id" value="<?= $manufacturer->id ?>">



            <div class="form-group">
                <label for="title" class="text-warning">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Put a title"
                       value="{{ old('_token')? old('title'): $manufacturer->title }}">
                @if($errors->has('title'))
                    <span class=" text-danger">{{ $errors->first('title') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-default">update</button>

        </form>
    </div>


    {{--<script src="{{ mix('js/admin/categories.js') }}"></script>--}}
@endsection