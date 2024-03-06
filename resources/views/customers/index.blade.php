@extends('adminlte::page')

@section('title', __('customers.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('customers.header') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ __('customers.success') }}</p>
        </div>
    @endif
    @if ($message = Session::get('insert-error'))
        <div class="alert alert-danger">
            <p>{{ __('customers.phone-error') }}</p>
        </div>
    @endif
@endsection

@section('content')
    @if (auth()->user()->role == App\Enums\UserRole::Administrator ||
         auth()->user()->role == App\Enums\UserRole::Operator ||
         auth()->user()->role == App\Enums\UserRole::Reseller)
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('customers.create') }}">{{ __('tables.new') }}</a>
            </div>
        </div>
    </div>
    @endif

    <div class="row col-md-12">
        @yield('messages')
    </div>

    @include('customers.table')

@endsection
