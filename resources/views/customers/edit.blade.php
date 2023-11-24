@extends('adminlte::page')

@section('title', __('customers.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('customers.header') }}</h1>
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
    <form id="customer-form" action="{{ route('customers.update',$customer->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('customers.name') }} :</strong>
                    <input type="text" name="name" value="{{ $customer->name }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('customers.phone') }} :</strong>
                    <input type="text" name="phone" value="{{ $customer->phone }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('customers.line_id') }} :</strong>
                    <input type="text" name="line_id" value="{{ $customer->line_id }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('customers.email') }} :</strong>
                    <input type="text" name="email" value="{{ $customer->email }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('customers.pid') }} :</strong>
                    <input type="text" name="pid" value="{{ $customer->pid }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('customers.address') }} :</strong>
                    <input type="text" name="address" value="{{ $customer->address }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('customers.sales') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                    <select id="sales_id" name="sales_id" >
                        @foreach ($sales as $s)
                           <option value="{{ $s->id }}" {{ ($s->id == $customer->sales_id) ? "selected" : null }} >{{ $s->name }}</option>
                        @endforeach
                  </select>
                </div>
           </div>
           @if (auth()->user()->role == App\Enums\UserRole::Administrator)
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('customers.status') }} :</strong>
                    <input type="checkbox" name="status" value="1" {{ $customer->status ? "checked" : null }}>
                    <label for="status">{{ __('tables.enabled') }}</label>
                </div>
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
           </div>
           @endif
           <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
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

