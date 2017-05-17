@extends('master')

@section('content')

    <ol class="breadcrumb">
        <li><a href="/">Main</a></li>
        <li><a href="{{ route('catalog') }}">Catalog</a></li>
        <li class="active">Categories</li>
    </ol>

    @include('custom.catalog.output')

@endsection