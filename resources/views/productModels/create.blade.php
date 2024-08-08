@extends('adminlte::page')

@section('title', __('productModels.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('productModels.header') }}</h1>
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
<form id="productModel-form" action="{{ route('productModels.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-6">
                <strong>{{ __('productModels.model') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="model" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <strong>{{ __('productModels.name') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <strong>{{ __('productModels.purchase_cost') }} :</strong>
                <select id="currency_id" name="currency_id" style="width: 100px;">
                      @foreach ($currencies as $currency)
                         <option value="{{ $currency->id }}" >{{ $currency->currency_name }}</option>
                      @endforeach
                </select>
                <input type="number" name="purchase_cost" step="0.01" placeholder="1.00">
            </div>
            <div class="form-group col-md-6">
                <strong>{{ __('productModels.price') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="number" name="price" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <strong>{{ __('productModels.vendor') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <select id="vendor_id" name="vendor_id" >
                      <option value="" selected>----------</option>
                      @foreach ($vendors as $vendor)
                         <option value="{{ $vendor->id }}" >{{ $vendor->company }}</option>
                      @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <strong>{{ __('productModels.catagory') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <select id="catagory_id" name="catagory_id" >
                      <option value="" selected>----------</option>
                      @foreach ($catagories as $catagory)
                         <option value="{{ $catagory->id }}" >{{ $catagory->name }}</option>
                      @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <strong>{{ __('productModels.accessories') }} :</strong>
                <select id="accessories" name="accessories" >
                      <option value="" selected>----------</option>
                      @foreach ($accessories as $accessory)
                         <option value="{{ $accessory->id }}" >{{ $accessory->name }}</option>
                      @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
              <table class="table table-bordered" id="briefsTable">
                <tr>
                    <th>{{ __('productModels.briefs') }}</th>
                    <th>{{ __('tables.action') }}</th>
                </tr>
                <tr>
                    <td><input type="text" name="briefs[0]" placeholder="Enter subject" class="form-control" />
                    </td>
                    <td><button type="button" name="add" id="briefAdd" class="btn btn-outline-primary">{{ __('tables.new') }}</button></td>
                </tr>
              </table>
            </div>
            <div class="form-group col-md-6">
              <table class="table table-bordered" id="specTable">
                <tr>
                    <th>{{ __('productModels.specifications') }}</th>
                    <th>{{ __('tables.action') }}</th>
                </tr>
                <tr>
                    <td><input type="text" name="specifications[0]" placeholder="Enter subject" class="form-control" />
                    </td>
                    <td><button type="button" name="add" id="specAdd" class="btn btn-outline-primary">{{ __('tables.new') }}</button></td>
                </tr>
              </table>
            </div>
            <div class="form-group col-md-6">
                <strong>{{ __('productModels.descriptions') }} :</strong>
                <textarea name="descriptions" class="form-control" rows="10"></textarea>
            </div>
            <div class="form-group col-md-6">
                <strong>{{ __('productModels.is_accessories') }} :</strong>
                <input type="checkbox" name="is_accessories" value="1" />
                <label for="is_accessories">{{ __('tables.yes') }}</label>
            </div>
            <div class="form-group col-md-6">
                <strong>{{ __('productModels.extras') }} :</strong>
                <input type="checkbox" name="extra" value="1" />
                <label for="extras">{{ __('tables.yes') }}</label>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $("#briefAdd").click(function () {
        ++i;
        $("#briefsTable").append('<tr><td><input type="text" name="briefs[' + i +
            ']" placeholder="Enter subject" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger removeBrief">刪除</button></td></tr>'
            );
    });
    $(document).on('click', '.removeBrief', function () {
        $(this).parents('tr').remove();
    });

    var j=0;
    $("#specAdd").click(function () {
        ++j;
        $("#specTable").append('<tr><td><input type="text" name="specifications[' + j +
            ']" placeholder="Enter subject" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger specBrief">刪除</button></td></tr>'
            );
    });
    $(document).on('click', '.specBrief', function () {
        $(this).parents('tr').remove();
    });

</script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#productModel-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               model: {
                  required: true
               },
               name: {
                  required: true
               },
               vendor_id: {
                  required: true
               },
               catagory_id: {
                  required: true
               },
           },
           messages: {
               model: {
                  required: '產品型號必填'
               },
               name: {
                  required: '產品品名必填'
               },
               vendor_id: {
                  required: '廠商必填'
               },
               catagory_id: {
                  required: '產品類別必填'
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
