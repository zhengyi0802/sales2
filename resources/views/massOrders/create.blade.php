@extends('adminlte::page')

@section('title', __('massorders.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('massorders.header') }}</h1>
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
@include('massOrders.products')
<form id="massOrder-form" action="{{ route('massOrders.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="raw card-group">
           <x-adminlte-input name="cname" label="{{ __('massorders.cname') }}" fgroup-class="col-md-6" />
           <x-adminlte-input type="date" name="order_date" label="{{ __('massorders.order_date') }}" fgroup-class="col-md-6" />
        </div>
        <div class="raw card-group">
           <x-adminlte-input name="phone" label="{{ __('massorders.phone') }}" fgroup-class="col-md-6" />
           <x-adminlte-input name="cid" label="{{ __('massorders.cid') }}" fgroup-class="col-md-6" />
        </div>
        <div class="raw card-group">
           <x-adminlte-input name="email" label="{{ __('massorders.email') }}" fgroup-class="col-md-6" />
           <x-adminlte-input name="line_id" label="{{ __('massorders.line_id') }}" fgroup-class="col-md-6" />
        </div>
        <div class="raw card-group">
           <x-adminlte-input name="address" label="{{ __('massorders.address') }}" fgroup-class="col-md-12" />
        </div>
        <div class="raw card-group">
          <p><strong>{{ __('massorders.orderitems') }}</strong></p>
          <table class="table table-bordered" id="productsTable">
            <tr>
                 <td>{{ __('massorders.product') }}</td>
                 <td>{{ __('massorders.amount') }}</td>
                 <td>{{ __('massorders.action') }}</td>
            </tr>
                <tr>
                    <td><input type="text" name="products[0]['product']"  id="product[0]" class="form-control" />
                        <x-adminlte-button label="{{ __('massorders.product') }}" data-toggle="modal" data-target="#productsModal"
                          class="bg-primary" data-whatever="0" />
                    </td>
                    <td><input type="number" name="products[0]['amount']" class="form-control" value="1" /></td>
                    <td><button type="button" name="add" id="productAdd" class="btn btn-outline-primary">{{ __('tables.new') }}</button>
                </tr>
          </table>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
        </div>
</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
    $('#productsModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('whatever'); // Extract info from data-* attributes
        $('#productItem').val(id + 1);
    })
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $("#productAdd").click(function () {
        ++i;
        var str = '<tr><td><input type="text" name="products[' + i + '][\'product\']" id="product[' + i + ']" class="form-control" />';
            str += '<button type="button" class="btn btn-default bg-primary" data-toggle="modal" data-target="#productsModal" data-whatever="' + i + '">品名</button></td>';
            str += '<td><input type="number" name="products[' + i + '][\'amount\']" class="form-control" value="1" /></td>';
            str += '<td><button type="button" class="btn btn-outline-danger removeItem">刪除</button></td></tr>';
        $("#productsTable").append(str);
    });
    $(document).on('click', '.removeItem', function () {
        $(this).parents('tr').remove();
    });

    $('#product_id').change(function() {
        d = document.getElementById("product_id").value;
        val = document.getElementById('productItem').value;
        item = val-1;
        var target = 'product[' + item + ']';
        document.getElementById(target).value = d;
    });
</script>

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
