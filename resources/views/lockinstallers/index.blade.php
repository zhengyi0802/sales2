@extends('adminlte::page')

@section('title', __('lockinstallers.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('lockinstallers.header') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ __('lockinstallers.success') }}</p>
        </div>
    @endif
    @if ($message = Session::get('insert-error'))
        <div class="alert alert-danger">
            <p>{{ __('lockinstallers.phone-error') }}</p>
        </div>
    @endif
@endsection

@section('content')
<!--
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="/lockinstallers?flow=9">{{ __('tables.export') }}</a>
            </div>
        </div>
    </div>
-->

    <div class="row col-md-12">
        @yield('messages')
    </div>
    @include('lockinstallers.table')

@endsection
