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
       .cell {
          border:solid 1px;
          padding-left:10px;
          padding-right:10px;
          text-align:center;
       }
       .cell2 {
          border:solid 1px;
          padding-left:10px;
          padding-right:10px;
          text-align:left;
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
                    <select id="flow" name="flow" onchange="checkflow(this)">
                      <option value="4" {{ ($shipping->order->flow == 4) ? "selected" : null }}>{{ trans_choice('orders.flows', 4) }}</option>
                      <option value="5" {{ ($shipping->order->flow == 5) ? "selected" : null }}>{{ trans_choice('orders.flows', 5) }}</option>
                      <option value="6" {{ ($shipping->order->flow == 6) ? "selected" : null }}>{{ trans_choice('orders.flows', 6) }}</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('shippings.installer') }} :</strong>
                    <select id="installer_id" name="installer_id">
                       @foreach($installers as $installer)
                         <option value="{{ $installer->id }}" {{ ($shipping->installer_id == $installer->id) ? "selected" : null }}>{{ $installer->name }}</option>
                       @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <strong>{{ __('shippings.shipping_date') }} :</strong>
                    <input type="datetime-local" name="shipping_date" value="{{ $shipping->shipping_date }}" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <strong>{{ __('orders.product') }}</strong>
                  <table style="border:solid 2px">
                    <tr>
                      <td class="cell">{{ __('shippings.id') }}</td>
                      <td class="cell">{{ __('shippings.product') }}</td>
                      <td class="cell">{{ __('shippings.amount') }}</td>
                      <td class="cell">{{ __('shippings.includes') }}</td>
                    </tr>
                    <tr>
                       <td class="cell">1</td>
                       <td class="cell2">
                         {{ $shipping->order->product->name.'('.$shipping->order->product->model.')' }}
                       </td>
                       <td class="cell">1</td>
                       <td class="cell">{{ __('tables.yes') }}</td>
                    </tr>
                    <tr>
                       <td class="cell">2</td>
                       <td class="cell2">
                          @if ($shipping->order->product->accessories > 0)
                             {{ $shipping->order->product->accessory->name.'('.$shipping->order->product->accessory->model.')' }}
                          @endif
                       </td>
                       <td class="cell">{{ ($shipping->order->product->accessories > 0) ? "1" : null }}</td>
                       <td class="cell">{{ ($shipping->order->product->accessories > 0) ? __('tables.yes') : null }}</td>
                    </tr>
                    <tr>
                       <td class="cell">3</td>
                       <td class="cell2">
                           @if (isset($shipping->order->extras[0]))
                               {{  $shipping->order->extras[0]->product->name.'('.$shipping->order->extras[0]->product->model.')' }}
                           @endif
                       </td>
                       <td class="cell">{{ isset($shipping->order->extras[0]) ? "1" : null }}</td>
                       <td class="cell">
                           @if (isset($shipping->order->extras[0]))
                               <input type="checkbox" name="includes[0]" value="1"
                                  {{ ($shipping->order->extras[0]->flow >= App\Enums\FlowStatus::Shipping) ? "checked" : null }}>
                               <label for="include[0]">{{ __('tables.yes') }}</label>
                           @endif
                       </td>
                    </tr>
                    <tr>
                       <td class="cell">4</td>
                       <td class="cell2">
                           @if (isset($shipping->order->extras[1]))
                               {{  $shipping->order->extras[1]->product->name.'('.$shipping->order->extras[1]->product->model.')' }}
                           @endif
                       </td>
                       <td class="cell">{{ isset($shipping->order->extras[1]) ? "1" : null }}</td>
                       <td class="cell">
                           @if (isset($shipping->order->extras[1]))
                               <input type="checkbox" name="includes[1]" value="1"
                                  {{ ($shipping->order->extras[1]->flow >= App\Enums\FlowStatus::Shipping) ? "checked" : null }}>
                               <label for="include[1]">{{ __('tables.yes') }}</label>
                           @endif
                        </td>
                    </tr>
                    <tr>
                       <td class="cell">5</td>
                       <td class="cell2">
                           @if (isset($shipping->order->extras[2]))
                               {{  $shipping->order->extras[2]->product->name.'('.$shipping->order->extras[2]->product->model.')' }}
                           @endif
                       </td>
                       <td class="cell">{{ isset($shipping->order->extras[2]) ? "1" : null }}</td>
                       <td class="cell">
                           @if (isset($shipping->order->extras[2]))
                               <input type="checkbox" name="includes[2]" value="1"
                                  {{ ($shipping->order->extras[2]->flow >= App\Enums\FlowStatus::Shipping) ? "checked" : null }} >
                               <label for="include[2]">{{ __('tables.yes') }}</label>
                           @endif
                        </td>
                    </tr>
                    <tr>
                       <td class="cell">6</td>
                       <td class="cell2">
                           @if (isset($shipping->order->extras[3]))
                               {{  $shipping->order->extras[3]->product->name.'('.$shipping->order->extras[3]->product->model.')' }}
                           @endif
                       </td>
                       <td class="cell">{{ isset($shipping->order->extras[3]) ? "1" : null }}</td>
                       <td class="cell">
                           @if (isset($shipping->order->extras[3]))
                               <input type="checkbox" name="includes[3]" value="1"
                                  {{ ($shipping->order->extras[0]->flow >= App\Enums\FlowStatus::Shipping) ? "checked" : null }}>
                               <label for="include[3]">{{ __('tables.yes') }}</label>
                           @endif
                        </td>
                    </tr>
                </table>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
           </div>
        </div>
    </form>
@endsection
