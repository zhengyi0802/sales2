@extends('adminlte::page')

@section('title', __('orders.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('orders.header') }}</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
      @include('orders.table2')
    @else
      @include('orders.table')
    @endif

@endsection
