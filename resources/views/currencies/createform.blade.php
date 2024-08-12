<form name="currency-new-form" action="{{ route('currencies.store') }}" method="POST" enctype="multipart/form-data" >
  @csrf
    <div class="card-group">
      <x-adminlte-input name="currency_name" label="{{ __('currencies.name') }}" fgroup-class="col-md-12" />
    </div>
    <div class="card-group">
      <x-adminlte-input type="number" step="0.01" name="currency_rate" label="{{ __('currencies.rate') }}" fgroup-class="col-md-12" />
    </div>
    <div class="card-group">
      <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
    </div>
</form>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#currency-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               currency_name: {
                  required: true
               },
           },
           messages: {
               currency_name: {
                  required: '貨幣名稱必填'
               },
           },
           submitHandler: function(form) {
                form.submit();
           }
        });
    });
</script>
@section('plugins.jqueryValidation', true)
