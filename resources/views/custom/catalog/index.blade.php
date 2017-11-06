@extends('layouts.master')

@section('content')

    <ol class="breadcrumb">
        <li><a href="/">Main</a></li>
        <li class="active">Ctalog</li>
    </ol>

    @include('custom.catalog.output')

@endsection