@extends('adminlte::page')

@section('title', __('newOrders.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('newOrders.header') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ __('newOrders.success') }}</p>
        </div>
    @endif
    @if ($message = Session::get('insert-error'))
        <div class="alert alert-danger">
            <p>{{ __('newOrders.phone-error') }}</p>
        </div>
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="/newOrders?flow=9">{{ __('tables.export') }}</a>
    @if (Auth()->user()->rolw <= App\Enums\UserRole::Accounter)
                <a class="btn btn-primary" href="/newOrders?flow=14">{{ __('tables.finished') }}</a>
            </div>
        </div>
    </div>
    @endif
    <div class="row col-md-12">
        @yield('messages')
    </div>
    @include('newOrders.table')

@endsection
