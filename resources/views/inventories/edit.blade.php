<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://sales2.mdo.tw/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://sales2.mdo.tw/vendor/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="https://sales2.mdo.tw/vendor/adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400it>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>
<body>
<div class="row">
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
<p><h3 class="m-0 text-dark">{{ __('inventories.product') }} : {{ $inventory->product->model.'('.$inventory->product->name.')' ?? '' }}</h3></p>
<form id="inventory-form" action="{{ route('inventories.update', $inventory->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('inventories.serial') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="serial" class="form-control" value="{{ $inventory->serial }}" disabled>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('inventories.product') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="product" class="form-control" value="{{ $inventory->product->model.'('.$inventory->product->name.')' }}" disabled>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('inventories.inbound') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="number" name="inbound" class="form-control" value="{{ $inventory->inbound }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('inventories.outbound') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="number" name="outbound" class="form-control" value="{{ $inventory->outbound }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('inventories.defective') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="number" name="defective" class="form-control" value="{{ $inventory->defective }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
        </div>
    </div>
</form>
<script src="https://sales2.mdo.tw/vendor/jquery/jquery.min.js"></script>
<script src="https://sales2.mdo.tw/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://sales2.mdo.tw/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="https://sales2.mdo.tw/vendor/adminlte/dist/js/adminlte.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" ></script>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#inventory-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
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
</body>
</html>

