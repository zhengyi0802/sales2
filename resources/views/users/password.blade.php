@extends('adminlte::page')

@section('title', __('password.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('password.header') }}</h1>
@stop

@section('content')

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
<form id="password-form" action="{{ route('users.savePassword', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('password.old_password') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="password" name="old_password" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('password.new_password') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="password" name="new_password" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('password.retry_password') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="password" name="retry_password" class="form-control">
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
        $('#password-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               old_password: {
                  required: true
               },
           },
           messages: {
               old_password: {
                  required: '姓名必填'
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
