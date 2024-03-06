@extends('adminlte::page')

@section('title', __('shippings.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('shippings.header') }}</h1>
@stop
<style>
    div.upgrade {
        margin-bottom : 20px;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.details') }}</h1>
            </div>
            @include('layouts.back')
            @if ((auth()->user()->role == App\Enums\UserRole::Administrator ||
                 auth()->user()->role == App\Enums\UserRole::Installer ||
                 auth()->user()->role == App\Enums\UserRole::Operator) &&
                 $shipping->order->flow < 5)
                <div class="card col-md-2">
                  <button onClick="window.location='{{ route('orders.shipment', $shipping->order->id); }}'" class="btn-primary">
                    {{ __('orders.shipment_button') }}
                  </button>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <table class="col-xs-12 col-sm-12 col-md-12">
          <tr>
             <td><x-adminlte-card title="{{ __('shippings.order_id') }}" theme="info" icon="fas fa-lg">
                    {{ $shipping->order_id }}
             </x-adminlte></td>
             <td><x-adminlte-card title="{{ __('shippings.name') }}" theme="info" icon="fas fa-lg">
                    {{ $shipping->order->name }}
             </x-adminlte></td>
             <td><x-adminlte-card title="{{ __('shippings.phone') }}" theme="info" icon="fas fa-lg">
                    {{ $shipping->order->phone }}
             </x-adminlte></td>
          </tr>
          <tr>
             <td colspan="3"><x-adminlte-card title="{{ __('shippings.address') }}" theme="info" icon="fas fa-lg">
                    {{ $shipping->order->address }}
             </x-adminlte></td>
          </tr>
          <tr>
             <td><x-adminlte-card title="{{ __('shippings.product') }}" theme="info" icon="fas fa-lg">
                    {{ $shipping->order->product ? $shipping->order->product->name.'('.$shipping->order->product->model.')' : null }}
             </x-adminlte></td>
             <td><x-adminlte-card title="{{ __('orders.price') }}" theme="info" icon="fas fa-lg">
                    {{ $shipping->order->price }}
             </x-adminlte></td>
             <td><x-adminlte-card title="{{ __('orders.flow') }}" theme="info" icon="fas fa-lg">
                    {{ trans_choice('orders.flows',$shipping->order->flow) }}
             </x-adminlte></td>
          </tr>
          <tr>
             <td><x-adminlte-card title="{{ __('shippings.shipping_date') }}" theme="info" icon="fas fa-lg">
                    {{ $shipping->shipping_date }}
             </x-adminlte></td>
             <td><x-adminlte-card title="{{ __('shippings.installer') }}" theme="info" icon="fas fa-lg">
                    {{ $shipping->installer ? $shipping->installer->name : null  }}
             </x-adminlte></td>
             <td><x-adminlte-card title="{{ __('shippings.completion_time') }}" theme="info" icon="fas fa-lg">
                    {{ $shipping->completion_time }}
             </x-adminlte></td>
          </tr>
        </table>
      </div>
    </div>
@endsection
