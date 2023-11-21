@extends('adminlte::page')

@section('title', __('productModels.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('productModels.header') }}</h1>
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
    <form id="productModel-form" action="{{ route('productModels.update',$productModel->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('productModels.name') }} :</strong>
                    <input type="text" name="name" value="{{ $productModel->name }}" class="form-control">
                </div>
           </div>
           <div class="form-group col-md-4">
                <strong>{{ __('productModels.vendor') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <select id="vendor_id" name="vendor_id" >
                      @foreach ($vendors as $vendor)
                         <option value="{{ $vendor->id }}" {{ ($vendor->id == $productModel->vendor_id) ? "selected" : null }} >{{ $vendor->name }}</option>
                      @endforeach
                </select>
           </div>
           <div class="form-group col-md-4">
                <strong>{{ __('productModels.catagory') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <select id="catagory_id" name="catagory_id" >
                      @foreach ($catagories as $catagory)
                         <option value="{{ $catagory->id }}" {{ ($catagory->id == $productModel->catagory_id) ? "selected" : null }} >{{ $catagory->name }}</option>
                      @endforeach
                </select>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
           </div>
        </div>
    </form>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#member-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               name: {
                  required: true
               },
           },
           messages: {
               name: {
                  required: '產品型號必填'
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

