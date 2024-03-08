<form name="catagory-new-form" action="{{ route('catagories.store') }}" method="POST" enctype="multipart/form-data" >
  @csrf
    <div class="card-group">
      <x-adminlte-input name="name" label="{{ __('catagories.name') }}" fgroup-class="col-md-12" />
    </div>
    <div class="card-group">
      <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
    </div>
</form>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#catagory-form').validate({
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
