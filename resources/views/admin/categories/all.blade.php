@extends('layouts.admin')

@section('content')


    <div class="center-block flex-centered">

        <div class="auto-margin">

            <h1 class="bg-danger text-center">Categories</h1>

            <ul class="list">
                {!!  $dropDownList !!}
            </ul>

        </div>


    </div>

@endsection

