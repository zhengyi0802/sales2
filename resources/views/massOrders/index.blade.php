@extends('adminlte::page')

@section('title', __('massorders.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('massorders.header') }}</h1>
@stop

@section('content')
    @if (auth()->user()->role != App\Enums\UserRole::ShareHolder && auth()->user()->role != App\Enums\UserRole::CSR)
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('massOrders.create') }}">{{ __('tables.new') }}</a>
            </div>
        </div>
    </div>
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
      @include('massOrders.table2')
    @else
      @include('massOrders.table')
    @endif

@endsection
