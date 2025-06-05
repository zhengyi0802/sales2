@extends('adminlte::page')

@section('title', __('eapplies.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('eapplies.header') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ __('eapplies.success') }}</p>
        </div>
    @endif
@endsection

@section('content')
@if ($eapply->flow == 8 || $eapply->flow == 9)
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-success" href="/eapplies/export?id={{ $eapply->id }}">{{ __('eapplies.export_button') }}</a>
                </div>
            </div>
        </div>
@endif

@if ($eapply->ecpayInvoiceData == null)
    @if ($eapply->flow == 14 || Auth()->user()->role <= App\Enums\UserRole::Accounter)
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-success" href="/issues/create?apply_id={{ $eapply->id }}">{{ __('tables.invoice_button') }}</a>
                </div>
            </div>
        </div>
    @endif
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
     <p>{{ Session::get('error') }}</p>
     </div>
     <div class="block">
       <p class="title"><strong>{{ __('eapplies.reseller') }} :</strong></p>
       <p class="result">{{ $eapply->reseller->name ?? '' }}</p>
     </div>
@if (false)
     <div class="block">
       <p class="title"><strong>{{ __('eapplies.zone1') }} :</strong></p>
       <p class="result">{{ ($eapply->community) ? $eapply->community->city.$eapply->community->zone : null }}</p>
     </div>
     <div class="block">
       <p class="title"><strong>{{ __('eapplies.community') }} :</strong></p>
       <p class="result">{{ ($eapply->community) ? $eapply->community->community : null }}</p>
     </div>
     <div class="block">
       <p class="title"><strong>{{ __('eapplies.persion') }} :</strong></p>
       <p class="result">{{ ($eapply->persion == 1) ? __('eapplies.persion_chair') : __('eapplies.persion_common') }}</p>
     </div>
@endif
     <div class="block">
       <p class="title"><strong>{{ __('eapplies.doorlock').__('eapplies.amount') }} :</strong> : {{ $eapply->amount }}</p>
     </div>
     <div class="block">
       <p class="title"><strong>{{ __('eapplies.bundles') }} :</strong></p>
       <p class="result">{{ __('eapplies.shield').__('eapplies.amount') }} : {{ json_decode($eapply->bundles)->shield ?? "0"  }}</p>
       <p class="result">{{ __('eapplies.battery').__('eapplies.amount') }} : {{ json_decode($eapply->bundles)->battery ?? "0"  }}</p>
     </div>
     <form id="eapply-form" action="{{ route('eapplies.update', $eapply->id) }}" method="POST">
         @method('PUT')
         @csrf
         <div class="block">
            <p class="title"><strong>{{ __('eapplies.name') }} :</strong></p>
            <p class="result">{{ $eapply->name }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('eapplies.line_id') }} :</strong></p>
            <p class="result">{{ $eapply->line_id }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('eapplies.email') }} :</strong></p>
            <p class="result">{{ $eapply->email }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('eapplies.phone') }} :</strong></p>
            <p class="result">{{ $eapply->phone }}</p>
         </div>
          <div class="block">
            <p class="title"><strong>{{ __('eapplies.address') }} :</strong></p>
            <p class="result">{{ $eapply->address }}</p>
          </div>
          <div class="block">
            <p class="title"><strong>{{ __('eapplies.placement') }} :</strong></p>
            <p class="result">{{ $eapply->placement }}</p>
          </div>
          <div class="block">
            <p class="title"><strong>{{ __('eapplies.project') }} :</strong></p>
            <p class="result">{{ __('eapplies.project_origin') }} : {{ $eapply->project->name }}</p>
              <p class="result">{{ __('eapplies.project_change') }} :
               <select id="project_id" name="project_id" onchange="checkProject(this)">
                 @foreach($eprojects as $eproject)
                     <option value="{{ $eproject->id }}" {{ ($eapply->project->id == $eproject->id) ? "selected" : null }} >{{ $eproject->name }}</option>
                 @endforeach
               </select>
              </p>
          </div>
          <div class="block">
            <p class="title"><strong>{{ __('eapplies.title_gifts') }} :</strong></p>
            @foreach ($gifts as $gift)
              @if ($gift == 'gift1')
                  <p class="result">{{ __('eapplies.gift1') }}</p>
              @elseif ($gift == 'gift2')
                  <p class="result">{{ __('eapplies.gift2') }}</p>
              @elseif ($gift == 'gift3')
                  <p class="result">{{ __('eapplies.gift3') }}</p>
              @elseif ($gift == 'gift4')
                  <p class="result">{{ __('eapplies.gift4') }}</p>
              @elseif ($gift == 'gift5')
                  <p class="result">{{ __('eapplies.gift5') }}</p>
              @elseif ($gift == 'gift6')
                  <p class="result">{{ __('eapplies.gift6') }}</p>
              @elseif ($gift == 'gift7')
                  <p class="result">{{ __('eapplies.gift7') }}</p>
              @endif
            @endforeach
          </div>
          <script>
            function checkProject(event) {
                var paid = document.getElementById('paid').value;
            }
          </script>
          <div class="block">
           <p class="title"><strong>{{ __('eapplies.flow') }} :</strong>{{ __('eapplies.no_remain') }}</p>
           <p class="result">
              <select id="flow" name="flow" onchange="checkflow(this)" {{ ($eapply->flow < 10) ? null : "disabled" }}>
                <option value="1" {{ ($eapply->flow == 1) ? "selected" : null }}>{{ trans_choice('eapplies.flows', 1) }}</option>
                <option value="2" {{ ($eapply->flow == 2) ? "selected" : null }}>{{ trans_choice('eapplies.flows', 2) }}</option>
                <option value="3" {{ ($eapply->flow == 3) ? "selected" : null }}>{{ trans_choice('eapplies.flows', 3) }}</option>
                <option value="4" {{ ($eapply->flow == 4) ? "selected" : null }}>{{ trans_choice('eapplies.flows', 4) }}</option>
                <option value="5" {{ ($eapply->flow == 5) ? "selected" : null }}>{{ trans_choice('eapplies.flows', 5) }}</option>
                <option value="6" {{ ($eapply->flow == 6) ? "selected" : null }}>{{ trans_choice('eapplies.flows', 6) }}</option>
                <option value="7" {{ ($eapply->flow == 7) ? "selected" : null }}>{{ trans_choice('eapplies.flows', 7) }}</option>
                <option value="8" {{ ($eapply->flow == 8) ? "selected" : null }}>{{ trans_choice('eapplies.flows', 8) }}</option>
                @if ($eapply->remain == 0)
                <option value="9" {{ ($eapply->flow == 9) ? "selected" : null }}>{{ trans_choice('eapplies.flows', 9) }}</option>
                @endif
                <option value="10" {{ ($eapply->flow == 10) ? "selected" : null }}>{{ trans_choice('eapplies.flows', 10) }}</option>
                <option value="11" {{ ($eapply->flow1 == 11) ? "selected" : null }}>{{ trans_choice('eapplies.flows', 11) }}</option>
                <option value="12" {{ ($eapply->flow1 == 12) ? "selected" : null }}>{{ trans_choice('eapplies.flows', 12) }}</option>
                <option value="13" {{ ($eapply->flow1 == 13) ? "selected" : null }}>{{ trans_choice('eapplies.flows', 13) }}</option>
                <option value="14" {{ ($eapply->flow1 == 14) ? "selected" : null }}>{{ trans_choice('eapplies.flows', 14) }}</option>
              </select>
           </p>
          </div>
          <script>
           function checkflow(event) {
               var total = document.getElementById('total').innerText;
               if(event.value == 8) {
                  if ( {{ $eapply->project->prepaid }} > 0 ) {
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
              <p class="title"><strong>{{ __('eapplies.payment') }} :</strong></p>
              <p class="result">{{ ($eapply->payment == 11) ? __('eapplies.payment_third') : __('eapplies.payment_credit') }}</p>
              <p class="result">{{ __('eapplies.total') }} : NTD <span id="total">{{ ($eapply->total > 0) ? $eapply->total : $total }}</span></p>
              @if ($eapply->flow < 9)
                 @if ($eapply->project->prepaid > 0)
                    <p class="result">{{ __('eapplies.prepay') }} : NTD <span id="prepay">{{ ($eapply->prepay_total) ? $eapply->prepay_total : $prepay }}</span></p>
                 @endif
                 <p class="result">{{ __('eapplies.paid') }} : NTD <input type="number" id="paid" name="paid" value="{{ $eapply->paid }}" ></p>
                 <p class="result">{{ __('eapplies.remain') }} : NTD <input type="number"  id="remain" name="remain" value="{{ $eapply->remain }}" ></p>
              @else
                 <p class="result">{{ __('eapplies.paid') }} : NTD {{ $eapply->paid }}</p>
                 <p class="result">{{ __('eapplies.remain') }} : NTD {{ $eapply->remain }}</p>
              @endif
              @if (isset($results) && ($results->rtn_code == '1'))
                 <div class="block1">
                     <p class="title"><button onclick="confirm(this)">{{ __('eapplies.confirm') }}</button>
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
           <p class="title"><strong>{{ __('eapplies.memo') }} :</strong></p>
           <p class="result"><textarea name="memo" class="col-md-12" >{{ $eapply->memo }}</textarea></p>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
          </div>
     </form>
     @if ($eapply->flow >= 10) {
         <div class="block">
            <p><strong>{{ __('eapplies.gastable') }}</strong></p>
            @include('eapplies.table2')
         </div>
     @endif
  </div>
@endsection
