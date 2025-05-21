@extends('adminlte::page')

@section('title', __('promotion2.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('promotion2.header') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ __('promotion2.success') }}</p>
        </div>
    @endif
    @if ($message = Session::get('insert-error'))
        <div class="alert alert-danger">
            <p>{{ __('promotion2.phone-error') }}</p>
        </div>
    @endif
@endsection

@section('content')
@if ($promotion2->flow == 8)
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-success" href="/promotion2/export?id={{ $promotion2->id }}">{{ __('promotion2.export_button') }}</a>
                </div>
            </div>
        </div>
@endif

@if (Auth()->user()->role <= App\Enums\UserRole::Accounter )
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-success" href="/issues/create?prom_id={{ $promotion2->id }}">{{ __('tables.invoice_button') }}</a>
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
       <p class="title"><strong>{{ __('promotion2.reseller') }} :</strong></p>
       <p class="result">{{ $promotion2->reseller->name ?? '' }}</p>
     </div>
     <form id="promotion-form" action="{{ route('promotion2.update', $promotion2->id) }}" method="POST">
         @method('PUT')
         @csrf
         <div class="block">
            <p class="title"><strong>{{ __('promotion2.name') }} :</strong></p>
            <p class="result">{{ $promotion2->name }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('promotion2.line_id') }} :</strong></p>
            <p class="result">{{ $promotion2->line_id }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('promotion2.email') }} :</strong></p>
            <p class="result">{{ $promotion2->email }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('promotion2.phone') }} :</strong></p>
            <p class="result">{{ $promotion2->phone }}</p>
         </div>
          <div class="block">
            <p class="title"><strong>{{ __('promotion2.address') }} :</strong></p>
            <p class="result">{{ $promotion2->address }}</p>
          </div>
          <div class="block">
            <p class="title"><strong>{{ __('promotion2.product') }} :</strong></p>
            <p class="result">{{ $promotion2->product->paytype }}</p>
          </div>
          <div class="block">
            <p class="title"><strong>{{ __('promotion2.bundles') }} :</strong></p>
            @foreach ($bundles as $bundle)
                @if ($bundle == 'DC2500')
                    <p class="result">{{ __('promotion2.DC2500') }}</p>
                @elseif ($bundle == 'DC3200')
                    <p class="result">{{ __('promotion2.DC3200') }}</p>
                @elseif ($bundle == 'DC5000')
                    <p class="result">{{ __('promotion2.DC5000') }}</p>
                @elseif ($bundle == 'DC6300')
                    <p class="result">{{ __('promotion2.DC6300') }}</p>
                @endif
            @endforeach
          </div>
          <div class="block">
            <p class="title"><strong>{{ __('promotion2.title_gifts') }} :</strong></p>
            @foreach ($gifts as $gift)
              @if ($gift == 'gift1')
                  <p class="result">{{ __('promotion2.gift1') }}</p>
              @elseif ($gift == 'gift2')
                  <p class="result">{{ __('promotion2.gift2') }}</p>
              @elseif ($gift == 'gift3')
                  <p class="result">{{ __('promotion2.gift3') }}</p>
              @elseif ($gift == 'gift4')
                  <p class="result">{{ __('promotion2.gift4') }}</p>
              @elseif ($gift == 'gift5')
                  <p class="result">{{ __('promotion2.gift5') }}</p>
              @elseif ($gift == 'gift6')
                  <p class="result">{{ __('promotion2.gift6') }}</p>
              @elseif ($gift == 'gift7')
                  <p class="result">{{ __('promotion2.gift7') }}</p>
              @endif
            @endforeach
          </div>
          <script>
            function checkProduct(event) {
                var paid = document.getElementById('paid').value;
            }
          </script>
          <div class="block">
           <p class="title"><strong>{{ __('promotion2.flow') }} :</strong>{{ __('promotion2.no_remain') }}</p>
           <p class="result">
              <select id="flow" name="flow" onchange="checkflow(this)" {{ ($promotion2->flow < 10) ? null : "disabled" }}>
                <option value="1" {{ ($promotion2->flow == 1) ? "selected" : null }}>{{ trans_choice('promotion2.flows', 1) }}</option>
                <option value="2" {{ ($promotion2->flow == 2) ? "selected" : null }}>{{ trans_choice('promotion2.flows', 2) }}</option>
                <option value="3" {{ ($promotion2->flow == 3) ? "selected" : null }}>{{ trans_choice('promotion2.flows', 3) }}</option>
                <option value="4" {{ ($promotion2->flow == 4) ? "selected" : null }}>{{ trans_choice('promotion2.flows', 4) }}</option>
                <option value="5" {{ ($promotion2->flow == 5) ? "selected" : null }}>{{ trans_choice('promotion2.flows', 5) }}</option>
                <option value="6" {{ ($promotion2->flow == 6) ? "selected" : null }}>{{ trans_choice('promotion2.flows', 6) }}</option>
                <option value="7" {{ ($promotion2->flow == 7) ? "selected" : null }}>{{ trans_choice('promotion2.flows', 7) }}</option>
                <option value="8" {{ ($promotion2->flow == 8) ? "selected" : null }}>{{ trans_choice('promotion2.flows', 8) }}</op>
                @if ($promotion2->remain == 0)
                <option value="9" {{ ($promotion2->flow == 9) ? "selected" : null }}>{{ trans_choice('promotion2.flows', 9) }}</op>
                @endif
                <option value="10" {{ ($promotion2->flow == 10) ? "selected" : null }}>{{ trans_choice('promotion2.flows', 10) }}</op>
                <option value="11" {{ ($promotion2->flow1 == 11) ? "selected" : null }}>{{ trans_choice('promotion2.flows', 11) }}>
                <option value="12" {{ ($promotion2->flow1 == 12) ? "selected" : null }}>{{ trans_choice('promotion2.flows', 12) }}>
                <option value="13" {{ ($promotion2->flow1 == 13) ? "selected" : null }}>{{ trans_choice('promotion2.flows', 13) }}>
                <option value="14" {{ ($promotion2->flow1 == 14) ? "selected" : null }}>{{ trans_choice('promotion2.flows', 14) }}>
              </select>
           </p>
          </div>
          <script>
           function checkflow(event) {
               var total = document.getElementById('total').innerText;
               if(event.value == 8) {
                  if ( {{ $promotion2->prepay_total }} > 0 ) {
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
              <p class="title"><strong>{{ __('promotion2.payment') }} :</strong></p>
              <p class="result">{{ ($promotion2->payment == 11) ? __('promotion2.payment_third') : __('promotion2.payment_credit') }}</p>
@if ($promotion2->paytype_id == 1)
              <p class="result">{{ __('promotion2.total') }} : NTD <span id="total">{{ $promotion2->total }}</span></p>
              @if ($promotion2->flow < 9)
                 <p class="result">{{ __('promotion2.paid') }} : NTD <input type="number" id="paid" name="paid" value="{{ $promotion2->paid }}" ></p>
                 <p class="result">{{ __('promotion2.remain') }} : NTD <input type="number"  id="remain" name="remain" value="{{ $promotion2->remain }}" ></p>
              @else
                 <p class="result">{{ __('promotion2.paid') }} : NTD {{ $promotion2->paid }}</p>
                 <p class="result">{{ __('promotion2.remain') }} : NTD {{ $promotion2->remain }}</p>
              @endif
@elseif ($promotion2->paytype_id == 2)
                 <p class="result">{{ __('promotion2.staging') }} : {{ $promotion2->staging }}</p>
                 <p class="result">{{ __('promotion2.stage_price') }} : NTD {{ $promotion2->stage_price }}</p>
@elseif ($promotion2->paytype_id == 3)
                 <p class="result">{{ __('promotion2.prepay_total') }} : NTD {{ $promotion2->prepay_total }}</p>
              @if ($promotion2->flow < 9)
                 <p class="result">{{ __('eapplies.paid') }} : NTD <input type="number" id="paid" name="paid" value="{{ $promotion2->paid }}" ></p>
              @else
                 <p class="result">{{ __('eapplies.paid') }} : NTD {{ $eapply->paid }}</p>
              @endif
                 <p class="result">{{ __('promotion2.staging') }} : {{ $promotion2->staging }}</p>
                 <p class="result">{{ __('promotion2.stage_price') }} : NTD {{ $promotion2->stage_price }}</p>
@endif
              @if (isset($results) && ($results->rtn_code == '1'))
                 <div class="block1">
                     <p class="title"><button onclick="confirm(this)">{{ __('promotion2.confirm') }}</button>
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
           <p class="title"><strong>{{ __('promotion2.memo') }} :</strong></p>
           <p class="result"><textarea name="memo" class="col-md-12" >{{ $promotion2->memo }}</textarea></p>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
          </div>
     </form>
     @if ($promotion2->flow >= 10) {
         <div class="block">
            <p><strong>{{ __('promotion2.gastable') }}</strong></p>
            @include('promotion2.table2')
         </div>
     @endif
  </div>
@endsection
