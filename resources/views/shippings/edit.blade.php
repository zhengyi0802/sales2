@extends('adminlte::page')

@section('title', __('shippings.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('shippings.header') }}</h1>
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
    <form id="shipping-form" action="{{ route('shippings.update',$shipping->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('shippings.order_id') }} :</strong>
                    <input type="text" name="order_id" value="{{ $shipping->order_id }}" class="form-control" disabled>
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('shippings.name') }} :</strong>
                    <input type="text" name="name" value="{{ $shipping->order->name }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('shippings.phone') }} :</strong>
                    <input type="text" name="phone" value="{{ $shipping->order->phone }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('shippings.address') }} :</strong>
                    <input type="text" name="address" value="{{ $shipping->order->address }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('shippings.flow') }} :</strong>
                    <td><select id="flow" name="flow" onchange="checkflow(this)">
                      <option value="3" {{ ($shipping->order->flow == 3) ? "selected" : null }}>{{ trans_choice('orders.flows', 3) }}</option>
                      <option value="4" {{ ($shipping->order->flow == 4) ? "selected" : null }}>{{ trans_choice('orders.flows', 4) }}</option>
                      <option value="5" {{ ($shipping->order->flow == 5) ? "selected" : null }}>{{ trans_choice('orders.flows', 5) }}</option>
                </select></td>
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('shippings.shipping_date') }} :</strong>
                    <input type="date" name="shipping_date" value="{{ $shipping->shipping_date }}" class="form-control">
                </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
           </div>
        </div>
    </form>
@endsection
