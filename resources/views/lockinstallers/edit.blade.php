@extends('adminlte::page')

@section('title', __('lockinstallers.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('lockinstallers.header') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ __('lockinstallers.success') }}</p>
        </div>
    @endif
    @if ($message = Session::get('insert-error'))
        <div class="alert alert-danger">
            <p>{{ __('lockinstallers.phone-error') }}</p>
        </div>
    @endif
@endsection

@section('content')
@if ($lockInstaller->flow == 8)
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-success" href="/lockinstallers/export?id={{ $lockInstaller->id }}">{{ __('lockinstallers.export_button') }}</a>
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
  p.title {
      margin-left : 10px;
  }
  p.result {
      margin-left : 30px;
  }
</style>




  <div class="content">
     <div class="block">
       <p class="title"><strong>{{ __('lockinstallers.reseller') }} :</strong></p>
       <p class="result">{{ $lockInstaller->reseller->name ?? '' }}</p>
     </div>
     <div class="block">
       <p class="title"><strong>{{ __('lockinstallers.doorlock').__('lockinstallers.amount') }} :</strong> : {{ $lockInstaller->amount }}</p>
     </div>
     <div class="block">
       <p class="title"><strong>{{ __('lockinstallers.bundles') }} :</strong></p>
       <p class="result"><strong>{{ __('lockinstallers.shield').__('lockinstallers.amount') }} : {{ json_decode($lockInstaller->bundles)->shield ?? "0"  }}</p>
       <p class="result"><strong>{{ __('lockinstallers.battery').__('lockinstallers.amount') }} : {{ json_decode($lockInstaller->bundles)->battery ?? "0"  }}</p>
     </div>
     <form id="eapply-form" action="{{ route('lockinstallers.update', $lockInstaller->id) }}" method="POST">
         @method('PUT')
         @csrf
         <div class="block">
            <p class="title"><strong>{{ __('lockinstallers.name') }} :</strong></p>
            <p class="result">{{ $lockInstaller->name }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('lockinstallers.line_id') }} :</strong></p>
            <p class="result">{{ $lockInstaller->line_id }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('lockinstallers.email') }} :</strong></p>
            <p class="result">{{ $lockInstaller->email }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('lockinstallers.phone') }} :</strong></p>
            <p class="result">{{ $lockInstaller->phone }}</p>
         </div>
          <div class="block">
            <p class="title"><strong>{{ __('lockinstallers.address') }} :</strong></p>
            <p class="result">{{ $lockInstaller->address }}</p>
          </div>
          <div class="block">
            <p class="title"><strong>{{ __('lockinstallers.placement') }} :</strong></p>
            <p class="result">{{ $lockInstaller->placement }}</p>
          </div>
          <div class="block">
            <p class="title"><strong>{{ __('lockinstallers.project') }} :</strong></p>
            <p class="result">{{ __('lockinstallers.project_origin') }} : {{ $lockInstaller->project->name }}</p>
              <p class="result">{{ __('lockinstallers.project_change') }} :
               <select id="project_id" name="project_id" onchange="checkProject(this)">
                 @foreach($eprojects as $eproject)
                     <option value="{{ $eproject->id }}" {{ ($lockInstaller->project->id == $eproject->id) ? "selected" : null }} >{{ $eproject->name }}</option>
                 @endforeach
               </select>
              </p>
          </div>
          <script>
            function checkProject(event) {
                var paid = document.getElementById('paid').value;
            }
          </script>
          <div class="block">
           <p class="title"><strong>{{ __('lockinstallers.flow') }} :</strong>{{ __('lockinstallers.no_remain') }}</p>
           <p class="result">
              <select id="flow" name="flow" onchange="checkflow(this)" {{ ($lockInstaller->flow < 10) ? null : "disabled" }}>
                <option value="1" {{ ($lockInstaller->flow == 1) ? "selected" : null }}>{{ trans_choice('lockinstallers.flows', 1) }}</option>
                <option value="2" {{ ($lockInstaller->flow == 2) ? "selected" : null }}>{{ trans_choice('lockinstallers.flows', 2) }}</option>
                <option value="3" {{ ($lockInstaller->flow == 3) ? "selected" : null }}>{{ trans_choice('lockinstallers.flows', 3) }}</option>
                <option value="4" {{ ($lockInstaller->flow == 4) ? "selected" : null }}>{{ trans_choice('lockinstallers.flows', 4) }}</option>
                <option value="5" {{ ($lockInstaller->flow == 5) ? "selected" : null }}>{{ trans_choice('lockinstallers.flows', 5) }}</option>
                <option value="6" {{ ($lockInstaller->flow == 6) ? "selected" : null }}>{{ trans_choice('lockinstallers.flows', 6) }}</option>
                <option value="7" {{ ($lockInstaller->flow == 7) ? "selected" : null }}>{{ trans_choice('lockinstallers.flows', 7) }}</option>
                <option value="8" {{ ($lockInstaller->flow == 8) ? "selected" : null }}>{{ trans_choice('lockinstallers.flows', 8) }}</op>
                @if ($lockInstaller->remain == 0)
                <option value="9" {{ ($lockInstaller->flow == 9) ? "selected" : null }}>{{ trans_choice('lockinstallers.flows', 9) }}</op>
                @endif
                <option value="10" {{ ($lockInstaller->flow == 10) ? "selected" : null }}>{{ trans_choice('lockinstallers.flows', 10) }}</op>
                <option value="11" {{ ($lockInstaller->flow1 == 11) ? "selected" : null }}>{{ trans_choice('lockinstallers.flows', 11) }}>
                <option value="12" {{ ($lockInstaller->flow1 == 12) ? "selected" : null }}>{{ trans_choice('lockinstallers.flows', 12) }}>
                <option value="13" {{ ($lockInstaller->flow1 == 13) ? "selected" : null }}>{{ trans_choice('lockinstallers.flows', 13) }}>
                <option value="14" {{ ($lockInstaller->flow1 == 14) ? "selected" : null }}>{{ trans_choice('lockinstallers.flows', 14) }}>
              </select>
           </p>
          </div>
          <script>
           function checkflow(event) {
               var total = document.getElementById('total').innerText;
               if(event.value == 8) {
                  if ( {{ $lockInstaller->project->prepaid }} > 0 ) {
                       var prepay = document.getElementById('prepay').innerText;
                       document.getElementById('paid').value = prepay;
                       document.getElementById('remain').value = total-prepay;
                  } else {
                       document.getElementById('paid').value = total;
                       document.getElementById('remain').value = 0;
                  }
               }
           }
          </script>
          <div class="block">
              <p class="title"><strong>{{ __('lockinstallers.payment') }} :</strong></p>
              <p class="result">{{ ($lockInstaller->payment == 11) ? __('lockinstallers.payment_third') : __('lockinstallers.payment_credit') }}</p>
              <p class="result">{{ __('lockinstallers.total') }} : NTD <span id="total">{{ ($lockInstaller->total > 0) ? $lockInstaller->total : $total }}</span></p>
              @if ($lockInstaller->flow < 9)
                 @if ($lockInstaller->project->prepaid > 0)
                    <p class="result">{{ __('lockinstallers.prepay') }} : NTD <span id="prepay">{{ ($lockInstaller->prepay_total) ? $lockInstaller->prepay_total : $prepay }}</span></p>
                 @endif
              <p class="result">{{ __('lockinstallers.paid') }} : NTD <input type="number" id="paid" name="paid" value="{{ $lockInstaller->paid }}" ></p>
              <p class="result">{{ __('lockinstallers.remain') }} : NTD <input type="number"  id="remain" name="remain" value="{{ $lockInstaller->remain }}" ></p>
              @else
              <p class="result">{{ __('lockinstallers.paid') }} : NTD {{ $lockInstaller->paid }}</p>
              <p class="result">{{ __('lockinstallers.remain') }} : NTD {{ $lockInstaller->remain }}</p>
              @endif
          </div>
          <div class="block">
           <p class="title"><strong>{{ __('lockinstallers.memo') }} :</strong></p>
           <p class="result"><textarea name="memo" class="col-md-12" >{{ $lockInstaller->memo }}</textarea></p>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
          </div>
     </form>
  </div>
@endsection
