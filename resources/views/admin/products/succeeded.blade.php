@extends('layouts.app')

@section('content')


@if (session('status'))
    <div class="alert alert-success">
        <h1 class="text-center text-danger"> {{ session('status') }}</h1>
    </div>



@endif


@endsection