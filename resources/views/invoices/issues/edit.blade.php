@extends('adminlte::page')

@section('title', __('invoices.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('tables.edit') }}{{ $issue->delay_flag ? __('invoices.DelayIssue') : __('invoices.Issue') }}</h1>
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
  <div class="raw">
      <div class="col-xs-12 col-sm-12 col-md-12">
         @if ($issue->delay_flag == 0)
             <div class="form-group col-md-12">
                 <strong>{{ __('issues.InvoiceNo') }} :</strong>
                {{ $issue->invoice_no }}
             </div>
             <div class="form-group col-md-12">
                <strong>{{ __('issues.InvoiceDate') }} :</strong>
                {{ $issue->invoice_date }}
             </div>
             <div class="form-group col-md-12">
                <strong>{{ __('invoices.random_number') }} :</strong>
                {{ $issue->random_number }}
             </div>
         @else
             <div class="form-group col-md-12">
                <strong>{{ __('invoices.tsr') }} :</strong>
                {{ $issue->tsr }}
             </div>
             <div class="form-group col-md-12">
                <strong>{{ __('issues.DelayDay') }} :</strong>
                {{ $issue->delay_day }}
             </div>
             <div class="form-group col-md-12">
                <strong>{{ __('invoices.trigger_date') }} :</strong>
                {{ $issue->trigger_date }}
             </div>
             <div class="form-group col-md-12">
                <strong>{{ __('invoices.order_number') }} :</strong>
                {{ $issue->order_number  }}
             </div>
         @endif
         @if ($issue->invalid_flag)
         <div class="form-group col-md-12">
            <strong>{{ __('invoices.invalid_date') }} :</strong>
            {{ $issue->invalid_date }}
         </div>
         <div class="form-group col-md-12">
            <strong>{{ __('invoices.invalid_reason') }} :</strong>
            {{ $issue->invalid_reason }}
         </div>
         @endif
     </div>
  </div>
  <div class="raw">
      <div class="col-xs-12 col-sm-12 col-md-12">
      @if ($issue->delay_flag)
      <form id="issue-form" method="POST" action="{{ route('invoices.EditDelayIssue') }}">
      @else
      <form id="issue-form" method="POST" action="{{ route('invoices.VoidWithReIssue') }}">
      @endif
         @csrf
         <input type="hidden" name="apply_id" value="{{ $issue->apply_id }}">
         <input type="hidden" name="prom_id" value="{{ $issue->prom_id }}">
         <input type="hidden" name="SalesAmount" value="{{ $issue->details()->SalesAmount }}">
     @if ($issue->delay_flag)
         <input type="hidden" name="Tsr" value="{{ $issue->tsr }}">
         <input type="hidden" name="DelayFlag" value="{{ $issue->delay_flag }}">
         <input type="hidden" name="DelayDay" value="{{ $issue->delay_day }}">
     @else
         <input type="hidden" name="invoice_no" value="{{ $issue->invoice_no }}">
     @endif
         <div class="form-group col-md-12">
            <strong>{{ __('issues.RelateNumber') }} :</strong>
            <input type="text" name="RelateNumber" value="{{ $issue->details()->RelateNumber }}">
         </div>
         <div class="form-group col-md-12">
            <strong>{{ __('issues.CustomerName') }} :</strong>
            <input type="text" name="CustomerName" value="{{ $issue->details()->CustomerName }}">
         </div>
         <div class="form-group col-md-12">
            <strong>{{ __('issues.CustomerIdentifier') }} :</strong>
            <input type="text" name="CustomerIdentifier" value="{{ $issue->details()->CustomerIdentifier }}">
         </div>
         <div class="form-group col-md-12">
            <strong>{{ __('issues.CustomerAddr') }} :</strong>
            <input type="text" name="CustomerAddr" class="form-group col-md-4" value="{{ $issue->details()->CustomerAddr }}">
         </div>
         <div class="form-group col-md-12">
            <strong>{{ __('issues.CustomerPhone') }} :</strong>
            <input type="text" name="CustomerPhone" value="{{ $issue->details()->CustomerPhone }}">
         </div>
         <div class="form-group col-md-12">
            <strong>{{ __('issues.CustomerEmail') }} :</strong>
            <input type="text" name="CustomerEmail" value="{{ $issue->details()->CustomerEmail }}">
         </div>
         <div class="form-group col-md-12">
            <strong>{{ __('issues.SalesAmount') }} :</strong>
            {{ $issue->details()->SalesAmount }}
         </div>
         <div class="form-group col-md-12">
            <strong>{{ __('issues.TaxType') }} :</strong>
            {{ trans_choice( __('issues.TaxTypes'), $issue->details()->TaxType) }}
         </div>
         <div class="form-group col-md-12">
            <strong>{{ __('issues.vat') }} :</strong>
            {{ ($issue->details()->vat) ? __('issues.vat_include') : __('issues.vat_exclude') }}
         </div>
         <div class="form-group col-md-12">
            <strong>{{ __('issues.InvoiceRemark') }} :</strong>
            <input type="text" name="InvoiceRemark" value="{{ $issue->details()->InvoiceRemark }}">
         </div>
         @if (!$issue->delay_flag)
         <div class="form-group col-md-12">
            <strong>{{ __('issues.VoidReason') }} :</strong>
            <input type="text" name="void_reason" value="">
         </div>
         @endif
         <div class="form-group col-md-12">
             @include('invoices.issues.table2')
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12 text-center">
         @if ($issue->delay_flag)
              <button type="submit" class="btn btn-primary">{{ __('tables.editdelayissue') }}</button>
         @else
              <button type="submit" class="btn btn-primary">{{ __('tables.reissue') }}</button>
         @endif
         </div>
      </form>
      </div>
  </div>
@endsection
