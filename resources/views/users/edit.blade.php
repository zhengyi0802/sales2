@extends('adminlte::page')

@section('title', __('users.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('users.header') }}</h1>
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
    <form id="user-form" action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('users.account') }} :</strong>
                    <input type="text" name="account" value="{{ $user->account }}" class="form-control" disabled>
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('users.name') }} :</strong>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('users.phone') }} :</strong>
                    <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('users.line_id') }} :</strong>
                    <input type="text" name="line_id" value="{{ $user->line_id }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('users.email') }} :</strong>
                    <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('users.address') }} :</strong>
                    <input type="text" name="address" value="{{ $user->address }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('users.password') }} :</strong>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('users.role') }} :</strong>
                    <select id="role" name="role">
                       <option value="2" {{ ($user->role == 2) ? "selected" : null }}>{{ trans_choice('users.roles', 2) }}</option>
                       <option value="3" {{ ($user->role == 3) ? "selected" : null }}>{{ trans_choice('users.roles', 3) }}</option>
                       <option value="5" {{ ($user->role == 5) ? "selected" : null }}>{{ trans_choice('users.roles', 5) }}</option>
                       <option value="6" {{ ($user->role == 6) ? "selected" : null }}>{{ trans_choice('users.roles', 6) }}</option>
                       <option value="8" {{ ($user->role == 8) ? "selected" : null }}>{{ trans_choice('users.roles', 8) }}</option>
                       <option value="9" {{ ($user->role == 9) ? "selected" : null }}>{{ trans_choice('users.roles', 9) }}</option>
                       <option value="10" {{ ($user->role == 10) ? "selected" : null }}>{{ trans_choice('users.roles', 10) }}</option>
                    </select>
                </div>
           </div>
           @if (auth()->user()->role == App\Enums\UserRole::Administrator)
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('users.status') }} :</strong>
                    <input type="checkbox" name="status" value="1" {{ $user->status ? "checked" : null }}>
                    <label for="status">{{ __('tables.enabled') }}</label>
                </div>
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
           </div>
           @endif
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

