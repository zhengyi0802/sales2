@extends('adminlte::page')

@section('title', __('inventories.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('inventories.header') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>{{ __('tables.new') }}</h1>
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
<form id="inventory-form" action="{{ route('inventories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('inventories.serial') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="serial" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('inventories.product') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <select name="product_id" class="form-control">
                   @foreach($products as $product)
                       <option value="{{ $product->id }}">{{ $product->model }}</option>
                   @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('inventories.inbound') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="number" name="inbound" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('inventories.outbound') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="number" name="outbound" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('inventories.defective') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="number" name="defective" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#inventory-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               serial: {
                  required: true
               },
               product_id: {
                  required: true
               },
               inbound: {
                  required: true
               },
               outbound: {
                  required: true
               },
               defective: {
                  required: true
               },
           },
           messages: {
               serial: {
                  required: '本期期號必填'
               },
               product_id: {
                  required: '產品型號必填'
               },
               inbound: {
                  required: '本期入庫數量必填'
               },
               outbound: {
                  required: '本期出貨數量必填'
               },
               defective: {
                  required: '本期不良品數量必填'
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
