@extends('adminlte::page')

@section('title', __('saleses.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('saleses.header') }}</h1>
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
    <form id="sales-form" action="{{ route('sales.update',$sales->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('saleses.name') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="name" value="{{ $sales->name }}" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('saleses.account') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="account" value="{{ $sales->user->account }}" class="form-control" disabled>
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('saleses.password') }} :</strong>
                    <input type="password" name="password" class="form-control" >
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('saleses.company') }} :</strong>
                    <input type="text" name="company" value="{{ $sales->company }}" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('saleses.phone') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <input type="text" name="phone" value="{{ $sales->phone }}" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('saleses.line_id') }} :</strong>
                    <input type="text" name="line_id" value="{{ $sales->line_id }}" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('saleses.email') }} :</strong>
                    <input type="text" name="email" value="{{ $sales->email }}" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('saleses.job') }} :</strong>
                    <input type="text" name="job" value="{{ $sales->job }}" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('saleses.address') }} :</strong>
                    <input type="text" name="address" value="{{ $sales->address }}" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('saleses.reseller') }} :</strong>
                    <input type="checkbox" name="reseller" value="1" {{ ($sales->user->role == App\Enums\UserRole::Reseller) ? "checked" : null }}>
                    <label for="reseller">{{ __('tables.enabled') }}</label>
                </div>
           </div>
           @if (auth()->user()->role == App\Enums\UserRole::Administrator)
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('saleses.status') }} :</strong>
                    <input type="checkbox" name="status" value="1" {{ $sales->status ? "checked" : null }}>
                    <label for="status">{{ __('tables.enabled') }}</label>
                </div>
           </div>
           @endif
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('saleses.upper') }}  : *({{ __('saleses.creator') }} : {{ $sales->creator->name }} )</strong>
                    <select id="upper_id" name="upper_id" >
                      @foreach ($uppers as $upper)
                          <option value="{{ $upper->id }}" {{ ($sales->upper_id == $upper->id) ? "selected" : null }} >{{ $upper->name }}</option>
                      @endforeach
                    </select>
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                  <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
                </div>
           </div>
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

