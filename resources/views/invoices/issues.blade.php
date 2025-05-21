@extends('adminlte::page')

@section('title', __('productModels.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('invoices.head') }}</h1>
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
    <x-adminlte-card title="一般開立電子發票">
    @include('invoices.issueTable')
    </x-adminlte-card>

    <x-adminlte-card title="延遲開立電子發票">
    @include('invoices.issueTable2')
    </x-adminlte-card>

@endsection
