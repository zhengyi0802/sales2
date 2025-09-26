@extends('adminlte::page')

@section('title', __('projects.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('projects.header') }}</h1>
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
@include('projects.products')
<form id="project-form" action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-6">
                <strong>{{ __('projects.name') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="name" class="form-control" value="{{ $project->name }}">
            </div>
            <div class="form-group col-md-6">
                <strong>{{ __('projects.details') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <textarea name="details" class="form-control" rows="10">{{ $project->details }}</textarea>
            </div>
            <div class="form-group col-md-6">
                <string>{{ __('projects.salesing') }} :</strong>
                <input type="checkbox" name="salesing" value="1" {{ ($project->salesing) ? "checked" : null }}>
                <label for="salesing">{{ __('tables.enabled') }}</label>
            </div>
            <div class="form-group col-md-6">
                <strong>{{ __('projects.reseller') }} :(複選*)</strong>
                <select id="resellers" name="resellers" row="10" multiple="multiple">
                    @foreach($resellers as $reseller)
                        <option value="{{ $reseller->id }}">{{ $reseller->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="raw card-group">
          <p><strong>{{ __('projects.products') }}</strong></p>
          <table class="table table-bordered" id="productsTable" width="100%">
                <tr>
                 <td>{{ __('projects.product') }}</td>
                 <td>{{ __('projects.price') }}</td>
                 <td>{{ __('projects.action') }}</td>
                </tr>
@php
  $i = 0;
@endphp
            @foreach($nproducts as $nproduct)
                <tr>
                    <td><input type="text" name="products[{{ $i }}]['product']"  id="product[{{ $i }}]" value="{{ $nproduct->name }}" class="form-control" />
                        <input type="number" name="products[{{ $i }}]['pid']" id="pid[{{ $i }}]" value="{{ $nproduct->product_id }}" hidden>
                        <x-adminlte-button label="{{ __('projects.product') }}" data-toggle="modal" data-target="#productsModal"
                          class="bg-primary" data-whatever="0" />
                    </td>
                    <td><input type="number" name="products[0]['price']" class="form-control" value="{{ $nproduct->price }}" /></td>
@if ($i == 0)
                    <td><button type="button" name="add" id="productAdd" class="btn btn-outline-primary">{{ __('tables.new') }}</button>
@else
                    <td><button type="button" class="btn btn-outline-danger removeItem">刪除</button></td>
@endif
                </tr>
@php
  $i++;
@endphp
            @endforeach
          </table>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    var i = {{ count($nproducts) }};
    $('#productsModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('whatever'); // Extract info from data-* attributes
        $('#productItem').val(id + 1);
    })
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    $("#productAdd").click(function () {
        ++i;
        var str = '<tr><td><input type="text" name="products[' + i + '][\'product\']" id="product[' + i + ']" class="form-control" />';
            str += '<input type="number" name="products[' + i + '][\'pid\']" id="pid[' + i + ']" hidden>';
            str += '<button type="button" class="btn btn-default bg-primary" data-toggle="modal" data-target="#productsModal" data-whatever="' + i + '">產品</button></td>';
            str += '<td><input type="number" name="products[' + i + '][\'price\']" class="form-control" value="0" /></td>';
            str += '<td><button type="button" class="btn btn-outline-danger removeItem">刪除</button></td></tr>';
        $("#productsTable").append(str);
    });
    $(document).on('click', '.removeItem', function () {
        $(this).parents('tr').remove();
    });

    $('#product_id').change(function() {
        let selectElement = document.getElementById('product_id');
        let selectedOption = selectElement.options[selectElement.selectedIndex];
        let name  = selectedOption.getAttribute('data-name');
        let pidvalue = selectedOption.getAttribute('data-pid');
        val  = document.getElementById('productItem').value;
        item = val-1;
        product = 'product[' + item + ']';
        pid = 'pid[' + item + ']';
        document.getElementById(pid).value = pidvalue;
        document.getElementById(product).value = name;
    });
</script>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#project-form').validate({
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
                  required: '方案必填'
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
