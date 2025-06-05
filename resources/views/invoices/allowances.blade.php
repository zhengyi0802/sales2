@extends('adminlte::page')

@section('title', __('allowances.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('allowances.header') }}</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
    <x-adminlte-card title="{{ __('allowances.Allowance') }}">
    @include('invoices.allowanceTable')
    </x-adminlte-card>

    <x-adminlte-card title="{{ __('allowances.AllowanceByCollegiate') }}">
    @include('invoices.allowanceTable2')
    </x-adminlte-card>

@endsection
