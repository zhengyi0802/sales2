@extends('adminlte::page')

@section('title', __('massorders.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('massorders.header') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>{{ __('tables.edit') }}</h1>
        </div>
        @include('layouts.back')
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<style>
   .error {
      color       : red;
      margin-left : 5px;
      font-size   : 12px;
   }
   label.error {
      display     : inline;
   }
   span.must {
      color     : red;
      font-size : 12px;
   }
</style>
<form id="massOrder-form" action="{{ route('massOrders.update', $massOrder->id) }}" method="POST">
    @method('PUT')
    @csrf
        <div class="raw card-group">
           <x-adminlte-input name="cname" label="{{ __('massorders.cname') }}" fgroup-class="col-md-6" value="{{ $massOrder->cname }}" />
           <x-adminlte-input type="date" name="order_date" label="{{ __('massorders.order_date') }}" fgroup-class="col-md-6"
              value="{{ $massOrder->order_date }}"/>
        </div>
        <div class="raw card-group">
           <x-adminlte-input name="phone" label="{{ __('massorders.phone') }}" fgroup-class="col-md-6"
              value="{{ $massOrder->phone }}" disabled />
           <x-adminlte-input name="cid" label="{{ __('massorders.cid') }}" fgroup-class="col-md-6" value="{{ $massOrder->cid }}" />
        </div>
        <div class="raw card-group">
           <x-adminlte-input name="email" label="{{ __('massorders.email') }}" fgroup-class="col-md-6"
              value="{{ $massOrder->email }}" />
           <x-adminlte-input name="line_id" label="{{ __('massorders.line_id') }}" fgroup-class="col-md-6"
              value="{{ $massOrder->line_id }}" />
        </div>
        <div class="raw card-group">
           <x-adminlte-input name="address" label="{{ __('massorders.address') }}" fgroup-class="col-md-12"
              value="{{ $massOrder->address }}" />
        </div>
        <div class="raw card-group">
           <x-adminlte-input name="invoice" label="{{ __('massorders.invoice') }}" fgroup-class="col-md-6"
              value="{{ $massOrder->invoice }}" />
           <x-adminlte-select name="flow" label="{{ __('massorders.flow') }}" fgroup-class="col-md-6" >
              <option value="1" {{ ($massOrder->flow == 1) ? "selected" : null }}>{{ trans_choice('massorders.flows', 1) }}</option>
              <option value="2" {{ ($massOrder->flow == 2) ? "selected" : null }}>{{ trans_choice('massorders.flows', 2) }}</option>
              <option value="3" {{ ($massOrder->flow == 3) ? "selected" : null }}>{{ trans_choice('massorders.flows', 3) }}</option>
              <option value="4" {{ ($massOrder->flow == 4) ? "selected" : null }}>{{ trans_choice('massorders.flows', 4) }}</option>
           </x-adminlte-select>
        </div>
        <div class="raw card-group">
           <x-adminlte-input type="date" name="outbound_date" label="{{ __('massorders.outbound_date') }}" fgroup-class="col-md-6"
              value="{{ $massOrder->outbound_date }}" />
           <x-adminlte-input type="date" name="arrived_date" label="{{ __('massorders.arrived_date') }}" fgroup-class="col-md-6"
              value="{{ $massOrder->arrived_date }}" />
        </div>
        <div class="raw card-group">
          <p><strong>{{ __('massorders.orderitems') }}</strong></p>
          @include('massOrders.edit.items')
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
        </div>
</form>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#massOrder-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               cname: {
                  required: true
               },
               order_date: {
                  required: true
               },
               phone: {
                  required: true
               },
               address: {
                  required: true
               },
           },
           messages: {
               cname: {
                  required: '訂購單位必填'
               },
               order_date: {
                  required: '訂購日期必填'
               },
               phone: {
                  required: '電話必填'
               },
               address: {
                  required: '送貨地址必填'
               },
           },
           submitHandler: function(form) {
                form.submit();
           }
        });
    });
</script>
@section('plugins.jqueryValidation', true)
@endsection
