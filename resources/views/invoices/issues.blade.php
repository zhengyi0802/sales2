@extends('adminlte::page')

@section('title', __('issues.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('issues.header') }}</h1>
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

    <x-adminlte-card title="查詢特定多筆發票">
        <form name="invoiceLists" action="{{ route('invoices.GetIssueList') }}" method="GET">
            <p>{{ __('invoices.begin_date') }} : <input type="date" name="BeginDate" value="{{ date('Y/m/d') }}"></p>
            <p>{{ __('invoices.end_date') }} : <input type="date" name="EndDate" value="{{ date('Y/m/d') }}"></p>
            <p>{{ __('invoices.num_per_page') }} : <input type="number" name="NumPerPage" value="100"></p>
            <p>{{ __('invoices.showing_page') }} : <input type="number" name="ShowingPage" value="10"></p>
            <p><button type="submit">{{ __('tables.submit') }}</button></p>
        </form>
    </x-adminlte-card>

@endsection
