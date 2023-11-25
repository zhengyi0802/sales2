@extends('adminlte::page')

@section('title', __('vendors.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('vendors.header') }}</h1>
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
<form id="vendor-form" action="{{ route('vendors.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('vendors.company') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="company" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('vendors.country') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="country" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('vendors.memo') }} :</strong>
                <textarea name="memo" class="form-control" rows="10"></textarea>
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
        $('#vendor-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               company: {
                  required: true
               },
               country: {
                  required: true
               },
           },
           messages: {
               company: {
                  required: '公司名稱必填'
               },
               country: {
                  required: '國家名稱必填'
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
