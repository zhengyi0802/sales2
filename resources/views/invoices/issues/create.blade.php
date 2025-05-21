@extends('adminlte::page')

@section('title', __('invoices.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('invoices.Issue') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ __('invoices.success') }}</p>
        </div>
    @endif
    @if ($message = Session::get('insert-error'))
        <div class="alert alert-danger">
            <p>{{ __('invoices.phone-error') }}</p>
        </div>
    @endif
@endsection

@section('content')
  <form id="issue-form" action="{{ route('invoices.Issue') }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group col-md-12">
            <strong>{{ __('issues.RelateNumber') }} :</strong>
            <input type="text" name="RelateNumber" value="{{ $issueData->RelateNumber }}">
        </div>
        <div class="form-group col-md-12">
            <strong>{{ __('issues.CustomerName') }} :</strong>
            <input type="text" name="CustomerName" value="{{ $issueData->CustomerName }}">
        </div>
        <div class="form-group col-md-12">
            <strong>{{ __('issues.CustomerIdentifier') }} :</strong>
            <input type="text" name="CustomerIdentifier" value="{{ $issueData->CustomerIdentifier }}">
        </div>
        <div class="form-group col-md-12">
            <strong>{{ __('issues.CustomerAddr') }} :</strong>
            <input type="text" name="CustomerAddr" value="{{ $issueData->CustomerAddr }}">
        </div>
        <div class="form-group col-md-12">
            <strong>{{ __('issues.CustomerPhone') }} :</strong>
            <input type="text" name="CustomerPhone" value="{{ $issueData->CustomerPhone }}">
        </div>
        <div class="form-group col-md-12">
            <strong>{{ __('issues.CustomerEmail') }} :</strong>
            <input type="text" name="CustomerEmail" value="{{ $issueData->CustomerEmail }}">
        </div>
        <div class="form-group col-md-12">
            <strong>{{ __('issues.SalesAmount') }} :</strong>
            <input type="number" name="SalesAmount" value="{{ $issueData->SalesAmount }}">
        </div>
        <div class="form-group col-md-12">
            <strong>{{ __('issues.TaxType') }} :</strong>
            {{ trans_choice( __('issues.TaxTypes'), $issueData->TaxType) }}
        </div>
        <div class="form-group col-md-12">
            <strong>{{ __('issues.vat') }} :</strong>
            {{ ($issueData->vat) ? __('issues.vat_include') : __('issues.vat_exclude') }}
        </div>
        <div class="form-group col-md-12">
            <strong>{{ __('issues.InvoiceRemark') }} :</strong>
            <input type="text" name="InvoiceRemark" value="{{ $issueData->InvoiceRemark }}">
        </div>
        <div class="form-group col-md-12">
            <p><strong>{{ __('issues.DelayIssue') }} :</strong>
            <input type="radio" id="DelayFlag_0" name="DelayFlag" value="0" checked>
            <label for="DelayFlag_0">{{ __('issues.option_ontime') }}</label>
            <input type="radio" id="DelayFlag_1" name="DelayFlag" value="1">
            <label for="DelayFlag_1">{{ __('issues.option_delay') }}</label></p>
            <p><strong>{{ __('issues.DelayDay') }} :</strong>
            <input type="number" name="DelayDay" value="{{ $issueData->DelayDay }}">
            <input type="hidden" name="Tsr" value="{{ $issueData->Tsr }}">
            <input type="hidden" name="NotifyURL" value="{{ $issueData->NotifyURL }}">
        </div>
        <div class="form-group col-md-12">
            @include('invoices.issues.table')
        </div>
        <div class="form-group col-md-12">
            <input type="hidden" name="apply_id" value="{{ $issueData->apply_id ?? 0 }}">
            <input type="hidden" name="prom_id" value="{{ $issueData->prom_id ?? 0 }}">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
         </div>
     </form>
  </div>
@endsection
