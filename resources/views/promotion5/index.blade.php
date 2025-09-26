@extends('adminlte::page')

@section('title', __('promotion5.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('promotion5.header') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ __('promotion5.success') }}</p>
        </div>
    @endif
    @if ($message = Session::get('insert-error'))
        <div class="alert alert-danger">
            <p>{{ __('promotion5.phone-error') }}</p>
        </div>
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="/promotion5?flow=9">{{ __('tables.export') }}</a>
    @if (Auth()->user()->rolw <= App\Enums\UserRole::Accounter)
                <a class="btn btn-primary" href="/promotion5?flow=14">{{ __('tables.finished') }}</a>
    @endif
            </div>
        </div>
    </div>

    <div class="row col-md-12">
        @yield('messages')
    </div>
    @include('promotion5.table')

@endsection
