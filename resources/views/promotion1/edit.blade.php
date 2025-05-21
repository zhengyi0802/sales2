@extends('adminlte::page')

@section('title', __('promotion1.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('promotion1.header') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ __('promotion1.success') }}</p>
        </div>
    @endif
    @if ($message = Session::get('insert-error'))
        <div class="alert alert-danger">
            <p>{{ __('promotion1.phone-error') }}</p>
        </div>
    @endif
@endsection

@section('content')
@if ($promotion1->flow == 8)
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-success" href="/promotion1/export?id={{ $promotion1->id }}">{{ __('promotion1.export_button') }}</a>
                </div>
            </div>
        </div>
@endif

@if (Auth()->user()->role <= App\Enums\UserRole::Accounter )
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-success" href="/issues/create?prom_id={{ $promotion1->id }}">{{ __('tables.invoice_button') }}</a>
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
       <p class="title"><strong>{{ __('promotion1.reseller') }} :</strong></p>
       <p class="result">{{ $promotion1->reseller->name ?? '' }}</p>
     </div>
     <form id="promotion-form" action="{{ route('promotion1.update', $promotion1->id) }}" method="POST">
         @method('PUT')
         @csrf
         <div class="block">
            <p class="title"><strong>{{ __('promotion1.name') }} :</strong></p>
            <p class="result">{{ $promotion1->name }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('promotion1.line_id') }} :</strong></p>
            <p class="result">{{ $promotion1->line_id }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('promotion1.email') }} :</strong></p>
            <p class="result">{{ $promotion1->email }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('promotion1.phone') }} :</strong></p>
            <p class="result">{{ $promotion1->phone }}</p>
         </div>
          <div class="block">
            <p class="title"><strong>{{ __('promotion1.address') }} :</strong></p>
            <p class="result">{{ $promotion1->address }}</p>
          </div>
          <div class="block">
            <p class="title"><strong>{{ __('promotion1.product') }} :</strong></p>
            <p class="result">{{ __('promotion1.product') }} : {{ $promotion1->product->model_name.$promotion1->product->paytype }}</p>
          </div>
          <div class="block">
            <p class="title"><strong>{{ __('promotion1.title_gifts') }} :</strong></p>
            @foreach ($gifts as $gift)
              @if ($gift == 'gift1')
                  <p class="result">{{ __('promotion1.gift1') }}</p>
              @elseif ($gift == 'gift2')
                  <p class="result">{{ __('promotion1.gift2') }}</p>
              @elseif ($gift == 'gift3')
                  <p class="result">{{ __('promotion1.gift3') }}</p>
              @elseif ($gift == 'gift4')
                  <p class="result">{{ __('promotion1.gift4') }}</p>
              @elseif ($gift == 'gift5')
                  <p class="result">{{ __('promotion1.gift5') }}</p>
              @elseif ($gift == 'gift6')
                  <p class="result">{{ __('promotion1.gift6') }}</p>
              @elseif ($gift == 'gift7')
                  <p class="result">{{ __('promotion1.gift7') }}</p>
              @endif
            @endforeach
          </div>
          <script>
            function checkProduct(event) {
                var paid = document.getElementById('paid').value;
            }
          </script>
          <div class="block">
           <p class="title"><strong>{{ __('promotion1.flow') }} :</strong>{{ __('promotion1.no_remain') }}</p>
           <p class="result">
              <select id="flow" name="flow" onchange="checkflow(this)" {{ ($promotion1->flow < 10) ? null : "disabled" }}>
                <option value="1" {{ ($promotion1->flow == 1) ? "selected" : null }}>{{ trans_choice('promotion1.flows', 1) }}</option>
                <option value="2" {{ ($promotion1->flow == 2) ? "selected" : null }}>{{ trans_choice('promotion1.flows', 2) }}</option>
                <option value="3" {{ ($promotion1->flow == 3) ? "selected" : null }}>{{ trans_choice('promotion1.flows', 3) }}</option>
                <option value="4" {{ ($promotion1->flow == 4) ? "selected" : null }}>{{ trans_choice('promotion1.flows', 4) }}</option>
                <option value="5" {{ ($promotion1->flow == 5) ? "selected" : null }}>{{ trans_choice('promotion1.flows', 5) }}</option>
                <option value="6" {{ ($promotion1->flow == 6) ? "selected" : null }}>{{ trans_choice('promotion1.flows', 6) }}</option>
                <option value="7" {{ ($promotion1->flow == 7) ? "selected" : null }}>{{ trans_choice('promotion1.flows', 7) }}</option>
                <option value="8" {{ ($promotion1->flow == 8) ? "selected" : null }}>{{ trans_choice('promotion1.flows', 8) }}</op>
                @if ($promotion1->remain == 0)
                <option value="9" {{ ($promotion1->flow == 9) ? "selected" : null }}>{{ trans_choice('promotion1.flows', 9) }}</op>
                @endif
                <option value="10" {{ ($promotion1->flow == 10) ? "selected" : null }}>{{ trans_choice('promotion1.flows', 10) }}</op>
                <option value="11" {{ ($promotion1->flow1 == 11) ? "selected" : null }}>{{ trans_choice('promotion1.flows', 11) }}>
                <option value="12" {{ ($promotion1->flow1 == 12) ? "selected" : null }}>{{ trans_choice('promotion1.flows', 12) }}>
                <option value="13" {{ ($promotion1->flow1 == 13) ? "selected" : null }}>{{ trans_choice('promotion1.flows', 13) }}>
                <option value="14" {{ ($promotion1->flow1 == 14) ? "selected" : null }}>{{ trans_choice('promotion1.flows', 14) }}>
              </select>
           </p>
          </div>
          <script>
           function checkflow(event) {
               var total = document.getElementById('total').innerText;
               if(event.value == 8) {
                  if ( {{ $promotion1->prepay_total }} > 0 ) {
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
              <p class="title"><strong>{{ __('promotion1.payment') }} :</strong></p>
              <p class="result">{{ ($promotion1->payment == 11) ? __('promotion1.payment_third') : __('promotion1.payment_credit') }}</p>
@if ($promotion1->paytype->total)
              <p class="result">{{ __('promotion1.total') }} : NTD <span id="total">{{ $promotion1->total }}</span></p>
              @if ($promotion1->flow < 9)
                 <p class="result">{{ __('promotion1.paid') }} : NTD <input type="number" id="paid" name="paid" value="{{ $promotion1->paid }}" ></p>
                 <p class="result">{{ __('promotion1.remain') }} : NTD <input type="number"  id="remain" name="remain" value="{{ $promotion1->remain }}" ></p>
              @else
                 <p class="result">{{ __('promotion1.paid') }} : NTD {{ $promotion1->paid }}</p>
                 <p class="result">{{ __('promotion1.remain') }} : NTD {{ $promotion1->remain }}</p>
              @endif
@elseif ($promotion1->paytype->prepay)
                 <p class="result">{{ __('promotion1.prepay_total') }} : NTD {{ $promotion1->prepay_total }}</p>
              @if ($promotion1->flow < 9)
                 <p class="result">{{ __('promotion1.paid') }} : NTD <input type="number" id="paid" name="paid" value="{{ $promotion1->paid }}">
              @else
                 <p class="result">{{ __('promotion1.paid') }} : NTD {{ $promotion1->paid }}</p>
              @endif
@elseif ($promotion1->paytype->shipping)
              <p class="result">{{ __('promotion1.shipping_total') }} : NTD {{ $promotion1->shipping_total }}</p>
@elseif ($promotion1->paytype->staging)
                 <p class="result">{{ __('promotion1.staging') }} : {{ $promotion1->staging }}</p>
                 <p class="result">{{ __('promotion1.stage_price') }} : NTD {{ $promotion1->stage_price }}</p>
@endif
              @if (isset($results) && ($results->rtn_code == '1'))
                 <div class="block1">
                     <p class="title"><button onclick="confirm(this)">{{ __('promotion1.confirm') }}</button>
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
           <p class="title"><strong>{{ __('promotion1.memo') }} :</strong></p>
           <p class="result"><textarea name="memo" class="col-md-12" >{{ $promotion1->memo }}</textarea></p>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
          </div>
     </form>
  </div>
@endsection
