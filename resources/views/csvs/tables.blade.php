@extends('adminlte::page')

@section('title', __('csvs.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('csvs.header') }}</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @include('csvs.table')

@endsection
