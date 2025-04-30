@extends('adminlte::page')

@section('title', __('ecpay.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('ecpay.header') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ __('ecpay.success') }}</p>
        </div>
    @endif
    @if ($message = Session::get('insert-error'))
        <div class="alert alert-danger">
            <p>{{ __('ecpay.phone-error') }}</p>
        </div>
    @endif
@endsection

@section('content')
    <div class="row col-md-12">
        @yield('messages')
    </div>
    @include('ecpay.table')
    <div class="row col-md-12">
    <h2>{{ __('ecpay.title2') }}<h2>
    </div>
    @include('ecpay.table2')
@endsection
