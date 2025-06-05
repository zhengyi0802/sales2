@extends('adminlte::page')

@section('title', __('invoices.GetIssueList'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('invoices.GetIssueList') }}</h1>
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
    <div class="raw">
        @include('invoices.invoiceTable')
    </div>
@endsection
