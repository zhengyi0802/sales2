@extends('adminlte::page')

@section('title', __('checkorders.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('checkorders.header') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ __('checkorders.success') }}</p>
        </div>
    @endif
    @if ($message = Session::get('insert-error'))
        <div class="alert alert-danger">
            <p>{{ __('checkorders.phone-error') }}</p>
        </div>
    @endif
@endsection

@section('content')
    <div class="row col-md-12">
        @yield('messages')
    </div>

    @include('checkOrders.table')

@endsection
