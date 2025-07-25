@extends('adminlte::page')

@section('title', __('promotion4.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('promotion4.header') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ __('promotion4.success') }}</p>
        </div>
    @endif
    @if ($message = Session::get('insert-error'))
        <div class="alert alert-danger">
            <p>{{ __('promotion4.phone-error') }}</p>
        </div>
    @endif
@endsection

@section('content')
@if ($promotion4->flow == 8 || $promotion4->flow == 9)
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-success" href="/promotion4/export?id={{ $promotion4->id }}">{{ __('promotion1.export_button') }}</a>
                </div>
            </div>
        </div>
@endif
@if ($promotion4->flow >= 10)
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" href="/promotion4/import?id={{ $promotion4->id }}">{{ __('tables.import') }}</a>
                </div>
            </div>
        </div>
@endif
@if ($promotion4->flow == 14)
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-info" href="/issues/create?prom_id={{ $promotion4->id }}">{{ __('tables.invoice_button') }}</a>
                </div>
            </div>
        </div>
@endif

<style>
  div.content {
      width            : 100%;
  }
  div.block {
      border           : 1px solid blue;
      border-radius    : 10px;
      margin-top       : 4px;
      margin-bottom    : 4px;
      background-color : white;
  }
  div.block1 {
      border           : 1px solid blue;
      border-radius    : 10px;
      margin-top       : 4px;
      margin-bottom    : 4px;
      background-color : yellow;
  }
  p.title {
      margin-left : 10px;
  }
  p.result {
      margin-left : 30px;
  }
</style>

  <div class="content">
     <div class="block">
       <p class="title"><strong>{{ __('promotion4.reseller') }} :</strong></p>
       <p class="result">{{ $promotion4->reseller->name ?? '' }}</p>
     </div>
     <form id="promotion-form" action="{{ route('promotion4.update', $promotion4->id) }}" method="POST">
         @method('PUT')
         @csrf
         <div class="block">
            <p class="title"><strong>{{ __('promotion4.name') }} :</strong></p>
            <p class="result">{{ $promotion4->name }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('promotion4.line_id') }} :</strong></p>
            <p class="result">{{ $promotion4->line_id }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('promotion4.email') }} :</strong></p>
            <p class="result">{{ $promotion4->email }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('promotion4.phone') }} :</strong></p>
            <p class="result">{{ $promotion4->phone }}</p>
         </div>
          <div class="block">
            <p class="title"><strong>{{ __('promotion4.address') }} :</strong></p>
            <p class="result">{{ $promotion4->address }}</p>
          </div>
          <div class="block">
            <p class="title"><strong>{{ __('promotion4.product') }} :</strong></p>
            <p class="result">{{ $promotion4->product->paytype }}</p>
          </div>
          <div class="block">
            <p class="title"><strong>{{ __('promotion4.title_gifts') }} :</strong></p>
            @foreach ($gifts as $gift)
               <p class="result">{{ $gift }}</p>
            @endforeach
          </div>
          <script>
            function checkProduct(event) {
                var paid = document.getElementById('paid').value;
            }
          </script>
          <div class="block">
           <p class="title"><strong>{{ __('promotion4.flow') }} :</strong>{{ __('promotion4.no_remain') }}</p>
           <p class="result">
              <select id="flow" name="flow" onchange="checkflow(this)" {{ ($promotion4->flow < 10) ? null : "disabled" }}>
                <option value="1" {{ ($promotion4->flow == 1) ? "selected" : null }}>{{ trans_choice('promotion4.flows', 1) }}</option>
                <option value="2" {{ ($promotion4->flow == 2) ? "selected" : null }}>{{ trans_choice('promotion4.flows', 2) }}</option>
                <option value="3" {{ ($promotion4->flow == 3) ? "selected" : null }}>{{ trans_choice('promotion4.flows', 3) }}</option>
                <option value="4" {{ ($promotion4->flow == 4) ? "selected" : null }}>{{ trans_choice('promotion4.flows', 4) }}</option>
                <option value="5" {{ ($promotion4->flow == 5) ? "selected" : null }}>{{ trans_choice('promotion4.flows', 5) }}</option>
                <option value="6" {{ ($promotion4->flow == 6) ? "selected" : null }}>{{ trans_choice('promotion4.flows', 6) }}</option>
                <option value="7" {{ ($promotion4->flow == 7) ? "selected" : null }}>{{ trans_choice('promotion4.flows', 7) }}</option>
                <option value="8" {{ ($promotion4->flow == 8) ? "selected" : null }}>{{ trans_choice('promotion4.flows', 8) }}</op>
                @if ($promotion4->remain == 0 && $promotion4->paid > 0)
                <option value="9" {{ ($promotion4->flow == 9) ? "selected" : null }}>{{ trans_choice('promotion4.flows', 9) }}</option>
                <option value="10" {{ ($promotion4->flow == 10) ? "selected" : null }}>{{ trans_choice('promotion4.flows', 10) }}</option>
                <option value="11" {{ ($promotion4->flow1 == 11) ? "selected" : null }}>{{ trans_choice('promotion4.flows', 11) }}</option>
                <option value="12" {{ ($promotion4->flow1 == 12) ? "selected" : null }}>{{ trans_choice('promotion4.flows', 12) }}</option>
                <option value="13" {{ ($promotion4->flow1 == 13) ? "selected" : null }}>{{ trans_choice('promotion4.flows', 13) }}</option>
                <option value="14" {{ ($promotion4->flow1 == 14) ? "selected" : null }}>{{ trans_choice('promotion4.flows', 14) }}</option>
                @endif
              </select>
           </p>
          </div>
          <script>
           function checkflow(event) {
               var total = document.getElementById('total').innerText;
               if(event.value == 8) {
                  if ( {{ $promotion4->prepay_total }} > 0 ) {
                       var prepay = document.getElementById('prepay').innerText;
                       document.getElementById('paid').value = prepay;
                       document.getElementById('remain').value = total-prepay;
                  } else {
                       document.getElementById('paid').value = total;
                       document.getElementById('remain').value = 0;
                  }
               }
           }
           function confirm(event) {
               var total = document.getElementById('total').innerText;
               document.getElementById('paid').value = total;
               document.getElementById('remain').value = 0;
           }
          </script>
          <div class="block">
              <p class="title"><strong>{{ __('promotion4.payment') }} :</strong></p>
              <p class="result">{{ ($promotion4->payment == 11) ? __('promotion4.payment_third') : __('promotion4.payment_credit') }}</p>
@if ($promotion4->paytype_id == 1)
              <p class="result">{{ __('promotion4.total') }} : NTD <span id="total">{{ $promotion4->total }}</span></p>
              @if ($promotion4->flow < 9)
                 <p class="result">{{ __('promotion4.paid') }} : NTD <input type="number" id="paid" name="paid" value="{{ $promotion4->paid }}" ></p>
                 <p class="result">{{ __('promotion4.remain') }} : NTD <input type="number"  id="remain" name="remain" value="{{ $promotion4->remain }}" ></p>
              @else
                 <p class="result">{{ __('promotion4.paid') }} : NTD {{ $promotion4->paid }}</p>
                 <p class="result">{{ __('promotion4.remain') }} : NTD {{ $promotion4->remain }}</p>
              @endif
@elseif ($promotion4->paytype_id == 2)
                 <p class="result">{{ __('promotion4.staging') }} : {{ $promotion4->staging }}</p>
                 <p class="result">{{ __('promotion4.stage_price') }} : NTD {{ $promotion4->stage_price }}</p>
@endif
              @if (isset($results) && ($results->rtn_code == '1'))
                 <div class="block1">
                     <p class="title"><button onclick="confirm(this)">{{ __('promotion4.confirm') }}</button>
                     <p class="title"><strong>{{ __('ecpay.payment_type') }} :</strong></p>
                     <p class="result">{{ $results->payment_type ?? '' }}</p>
                     <p class="title"><strong>{{ __('ecpay.payment_date') }} :</strong></p>
                     <p class="result">{{ $results->payment_date ?? '' }}</p>
                     <p class="title"><strong>{{ __('ecpay.trade_amount') }} :</strong></p>
                     <p class="result">{{ 'NTD '.($results->trade_amount ?? '') }}</p>
                     <p class="title"><strong>{{ __('ecpay.rtn_msg') }} :</strong></p>
                     <p class="result">{{ $results->rtn_msg ?? ''}}</p>
                 </div>
              @endif
          </div>
          <div class="block">
           <p class="title"><strong>{{ __('promotion4.memo') }} :</strong></p>
           <p class="result"><textarea name="memo" class="col-md-12" >{{ $promotion4->memo }}</textarea></p>
          </div>
          @if (auth()->user()->role == App\Enums\UserRole::Administrator)
          <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('promotion4.status') }} :</strong>
                    <input type="checkbox" name="status" value="1" {{ $promotion4->status ? "checked" : null }}>
                    <label for="status">{{ __('tables.enabled') }}</label>
                </div>
          </div>
          @endif
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
          </div>
     </form>
     @if ($promotion4->flow >= 10) {
         <div class="block">
            <p><strong>{{ __('eapplies.gastable') }}</strong></p>
            @include('promotion4.table2')
         </div>
     @endif
     @if ($promotion4->ecpayInvoiceData != null)
         <div class="block">
            <p><strong>{{ __('promotion4.issuetable') }}</strong></p>
            @include('promotion4.issueTable')
         </div>
     @endif
  </div>
@endsection
