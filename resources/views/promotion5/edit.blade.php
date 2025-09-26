@extends('adminlte::page')

@section('title', __('promotion5.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('promotion5.header') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ __('promotion5.success') }}</p>
        </div>
    @endif
    @if ($message = Session::get('insert-error'))
        <div class="alert alert-danger">
            <p>{{ __('promotion5.phone-error') }}</p>
        </div>
    @endif
@endsection

@section('content')
@if ($promotion5->flow == 8 || $promotion5->flow == 9)
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-success" href="/promotion5/export?id={{ $promotion5->id }}">{{ __('promotion1.export_button') }}</a>
                </div>
            </div>
        </div>
@endif
@if ($promotion5->flow >= 10)
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" href="/promotion5/import?id={{ $promotion5->id }}">{{ __('tables.import') }}</a>
                </div>
            </div>
        </div>
@endif
@if ($promotion5->flow == 14)
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-info" href="/issues/create?prom_id={{ $promotion5->id }}">{{ __('tables.invoice_button') }}</a>
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
       <p class="title"><strong>{{ __('promotion5.reseller') }} :</strong></p>
       <p class="result">{{ $promotion5->reseller->name ?? '' }}</p>
     </div>
     <form id="promotion-form" action="{{ route('promotion5.update', $promotion5->id) }}" method="POST">
         @method('PUT')
         @csrf
         <div class="block">
            <p class="title"><strong>{{ __('promotion5.name') }} :</strong></p>
            <p class="result">{{ $promotion5->name }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('promotion5.line_id') }} :</strong></p>
            <p class="result">{{ $promotion5->line_id }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('promotion5.email') }} :</strong></p>
            <p class="result">{{ $promotion5->email }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('promotion5.phone') }} :</strong></p>
            <p class="result">{{ $promotion5->phone }}</p>
         </div>
          <div class="block">
            <p class="title"><strong>{{ __('promotion5.address') }} :</strong></p>
            <p class="result">{{ $promotion5->address }}</p>
          </div>
          <div class="block">
            <p class="title"><strong>{{ __('promotion5.product') }} :</strong></p>
            <p class="result">{{ $promotion5->product->paytype }}</p>
          </div>
          <div class="block">
            <p class="title"><strong>{{ __('promotion5.bundles') }} :</strong></p>
            @foreach ($bundles as $bundle)
                @if ($bundle == 'DC2500')
                    <p class="result">{{ __('promotion5.DC2500') }}</p>
                @elseif ($bundle == 'DC3200')
                    <p class="result">{{ __('promotion5.DC3200') }}</p>
                @elseif ($bundle == 'DC5000')
                    <p class="result">{{ __('promotion5.DC5000') }}</p>
                @elseif ($bundle == 'DC6300')
                    <p class="result">{{ __('promotion5.DC6300') }}</p>
                @endif
            @endforeach
          </div>
          <div class="block">
            <p class="title"><strong>{{ __('promotion5.title_gifts') }} :</strong></p>
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
           <p class="title"><strong>{{ __('promotion5.flow') }} :</strong>{{ __('promotion5.no_remain') }}</p>
           <p class="result">
              <select id="flow" name="flow" onchange="checkflow(this)" {{ ($promotion5->flow < 10) ? null : "disabled" }}>
                <option value="1" {{ ($promotion5->flow == 1) ? "selected" : null }}>{{ trans_choice('promotion5.flows', 1) }}</option>
                <option value="2" {{ ($promotion5->flow == 2) ? "selected" : null }}>{{ trans_choice('promotion5.flows', 2) }}</option>
                <option value="3" {{ ($promotion5->flow == 3) ? "selected" : null }}>{{ trans_choice('promotion5.flows', 3) }}</option>
                <option value="4" {{ ($promotion5->flow == 4) ? "selected" : null }}>{{ trans_choice('promotion5.flows', 4) }}</option>
                <option value="5" {{ ($promotion5->flow == 5) ? "selected" : null }}>{{ trans_choice('promotion5.flows', 5) }}</option>
                <option value="6" {{ ($promotion5->flow == 6) ? "selected" : null }}>{{ trans_choice('promotion5.flows', 6) }}</option>
                <option value="7" {{ ($promotion5->flow == 7) ? "selected" : null }}>{{ trans_choice('promotion5.flows', 7) }}</option>
                <option value="8" {{ ($promotion5->flow == 8) ? "selected" : null }}>{{ trans_choice('promotion5.flows', 8) }}</op>
                <option value="9" {{ ($promotion5->flow == 9) ? "selected" : null }}>{{ trans_choice('promotion5.flows', 9) }}</option>
                @if (true)
                <option value="10" {{ ($promotion5->flow == 10) ? "selected" : null }}>{{ trans_choice('promotion5.flows', 10) }}</option>
                <option value="11" {{ ($promotion5->flow1 == 11) ? "selected" : null }}>{{ trans_choice('promotion5.flows', 11) }}</option>
                <option value="12" {{ ($promotion5->flow1 == 12) ? "selected" : null }}>{{ trans_choice('promotion5.flows', 12) }}</option>
                <option value="13" {{ ($promotion5->flow1 == 13) ? "selected" : null }}>{{ trans_choice('promotion5.flows', 13) }}</option>
                <option value="14" {{ ($promotion5->flow1 == 14) ? "selected" : null }}>{{ trans_choice('promotion5.flows', 14) }}</option>
                @endif
              </select>
           </p>
          </div>
          <script>
           function checkflow(event) {
               var total = document.getElementById('total').innerText;
               if(event.value == 8) {
                  if ( {{ $promotion5->prepay_total }} > 0 ) {
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
              <p class="title"><strong>{{ __('promotion5.payment') }} :</strong></p>
              <p class="result">{{ ($promotion5->payment == 11) ? __('promotion5.payment_third') : __('promotion5.payment_credit') }}</p>
@if ($promotion5->paytype_id == 1)
              <p class="result">{{ __('promotion5.total') }} : NTD <span id="total">{{ $promotion5->total }}</span></p>
              @if ($promotion5->flow < 9)
                 <p class="result">{{ __('promotion5.paid') }} : NTD <input type="number" id="paid" name="paid" value="{{ $promotion5->paid }}" ></p>
                 <p class="result">{{ __('promotion5.remain') }} : NTD <input type="number"  id="remain" name="remain" value="{{ $promotion5->remain }}" ></p>
              @else
                 <p class="result">{{ __('promotion5.paid') }} : NTD {{ $promotion5->paid }}</p>
                 <p class="result">{{ __('promotion5.remain') }} : NTD {{ $promotion5->remain }}</p>
              @endif
@elseif ($promotion5->paytype_id == 2)
                 <p class="result">{{ __('promotion5.staging') }} : {{ $promotion5->staging }}</p>
                 <p class="result">{{ __('promotion5.stage_price') }} : NTD {{ $promotion5->stage_price }}</p>
@elseif ($promotion5->paytype_id == 3)
                 <p class="result">{{ __('promotion5.prepay_total') }} : NTD {{ $promotion5->prepay_total }}</p>
              @if ($promotion5->flow < 9)
                 <p class="result">{{ __('eapplies.paid') }} : NTD <input type="number" id="paid" name="paid" value="{{ $promotion5->paid }}" ></p>
              @else
                 <p class="result">{{ __('eapplies.paid') }} : NTD {{ $eapply->paid }}</p>
              @endif
                 <p class="result">{{ __('promotion5.staging') }} : {{ $promotion5->staging }}</p>
                 <p class="result">{{ __('promotion5.stage_price') }} : NTD {{ $promotion5->stage_price }}</p>
@endif
              @if (isset($results) && ($results->rtn_code == '1'))
                 <div class="block1">
                     <p class="title"><button onclick="confirm(this)">{{ __('promotion5.confirm') }}</button>
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
           <p class="title"><strong>{{ __('promotion5.memo') }} :</strong></p>
           <p class="result"><textarea name="memo" class="col-md-12" >{{ $promotion5->memo }}</textarea></p>
          </div>
          @if (auth()->user()->role == App\Enums\UserRole::Administrator)
          <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('promotion5.status') }} :</strong>
                    <input type="checkbox" name="status" value="1" {{ $promotion5->status ? "checked" : null }}>
                    <label for="status">{{ __('tables.enabled') }}</label>
                </div>
          </div>
          @endif
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
          </div>
     </form>
     @if ($promotion5->flow >= 10) {
         <div class="block">
            <p><strong>{{ __('eapplies.gastable') }}</strong></p>
            @include('promotion5.table2')
         </div>
     @endif
     @if ($promotion5->ecpayInvoiceData != null)
         <div class="block">
            <p><strong>{{ __('promotion5.issuetable') }}</strong></p>
            @include('promotion5.issueTable')
         </div>
     @endif
  </div>
@endsection
