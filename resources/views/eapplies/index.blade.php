@extends('adminlte::page')

@section('title', __('eapplies.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('eapplies.header') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ __('eapplies.success') }}</p>
        </div>
    @endif
    @if ($message = Session::get('insert-error'))
        <div class="alert alert-danger">
            <p>{{ __('eapplies.phone-error') }}</p>
        </div>
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="/eapplies?flow=9">{{ __('tables.export') }}</a>
            </div>
        </div>
    </div>

    <div class="row col-md-12">
        @yield('messages')
    </div>
    @include('eapplies.table')

@endsection
