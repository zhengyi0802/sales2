@extends('adminlte::page')

@section('title', __('saleses.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('saleses.header') }}</h1>
@stop

@section('content')
    @if (auth()->user()->role <= App\Enums\UserRole::Manager)
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('sales.create') }}">{{ __('tables.new') }}</a>
            </div>
        </div>
    </div>
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @include('sales.table')

@endsection
