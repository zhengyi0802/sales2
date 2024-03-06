@extends('adminlte::page')

@section('title', __('profiles.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('profiles.header') }}</h1>
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
    @if ($user->role == App\Enums\UserRole::Sales ||
         $user->role == App\Enums\UserRole::Reseller )
         <x-adminlte-card title="{{ __('saleses.sales_link') }}" theme="info" icon="fas fa-lg">
                <span id="url">{{ __('saleses.sales_http').$user->sales->id }}</span>
                <a href="#" onclick="CopyToClipboard('url');return false;">{{ __('tables.copylink') }}</a><br>
         </x-adminlte>
    @endif
    <form id="user-form" action="{{ route('users.saveProfile',$user->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('profiles.name') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('profiles.account') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="account" value="{{ $user->account }}" class="form-control" disabled>
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('profiles.password') }} :</strong>
                    <input type="password" name="password" value="" class="form-control" >
                </div>
           </div>
           @if ($user->role == App\Enums\UserRole::Sales ||
                $user->role == App\Enums\UserRole::Reseller)
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('profiles.company') }} :</strong>
                    <input type="text" name="company" value="{{ $user->company }}" class="form-control">
                </div>
           </div>
           @endif
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('profiles.phone') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('profiles.line_id') }} :</strong>
                    <input type="text" name="line_id" value="{{ $user->line_id }}" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('profiles.email') }} :</strong>
                    <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                </div>
           </div>
           @if ($user->role == App\Enums\UserRole::Sales ||
                $user->role == App\Enums\UserRole::Reseller)
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('profiles.job') }} :</strong>
                    <input type="text" name="job" value="{{ $user->job }}" class="form-control">
                </div>
           </div>
           @endif
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('profiles.address') }} :</strong>
                    <input type="text" name="address" value="{{ $user->address }}" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('profiles.role') }} : {{ trans_choice('users.roles', $user->role) }}</strong>
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                  <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
                </div>
           </div>
        </div>
    </form>
<script>
    function CopyToClipboard(id)
    {
        var r = document.createRange();
        r.selectNode(document.getElementById(id));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(r);
        document.execCommand('copy');
        window.getSelection().removeAllRanges();
    }
</script>
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
               account: {
                  required: true
               },
               phone: {
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
               phone: {
                  required: '電話必填'
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

