@extends('adminlte::page')

@section('title', __('processes.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('processes.header') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ __('processes.success') }}</p>
        </div>
    @endif
    @if ($message = Session::get('insert-error'))
        <div class="alert alert-danger">
            <p>{{ __('processes.phone-error') }}</p>
        </div>
    @endif
@endsection

@section('content')
    <div class="row col-md-12">
        @yield('messages')
    </div>
    @include('processes.table')

@endsection
