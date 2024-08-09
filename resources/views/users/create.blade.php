@extends('adminlte::page')

@section('title', __('users.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('users.header') }}</h1>
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
<form id="user-form" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('users.account') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="account" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('users.name') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('users.phone') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('users.line_id') }} :</strong>
                <input type="text" name="line_id" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('users.email') }} :</strong>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('users.address') }} :</strong>
                <input type="text" name="address" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('users.password') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <strong>{{ __('users.role') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <select id="role" name="role">
                   <option value="2" >{{ trans_choice('users.roles', 2) }}</option>
                   <option value="3" >{{ trans_choice('users.roles', 3) }}</option>
                   <option value="4" >{{ trans_choice('users.roles', 4) }}</option>
                   <option value="5" >{{ trans_choice('users.roles', 5) }}</option>
                   <option value="6" >{{ trans_choice('users.roles', 6) }}</option>
                   <option value="7" >{{ trans_choice('users.roles', 7) }}</option>
                   <option value="8" >{{ trans_choice('users.roles', 8) }}</option>
                   <option value="9" >{{ trans_choice('users.roles', 9) }}</option>
                   <option value="10" >{{ trans_choice('users.roles', 10) }}</option>
                   <option value="11" >{{ trans_choice('users.roles', 11) }}</option>
                </select>
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
        $('#user-form').validate({
           onkeyup: function(element, event) {
               var value = this.elementValue(element).replace(/^\s+/g, "");
               $(element).val(value);
           },
           rules: {
               name: {
                  required: true
               },
               account: {
                  required: true
               },
               password: {
                  required: true
               },
           },
           messages: {
               name: {
                  required: '姓名必填'
               },
               account: {
                  required: '帳號必填'
               },
               password: {
                  required: '密碼必填'
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
