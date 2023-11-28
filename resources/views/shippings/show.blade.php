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
        </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <x-adminlte-card title="{{ __('shippings.order_id') }}" theme="info" icon="fas fa-lg">
                {{ $shipping->order_id }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('shippings.name') }}" theme="info" icon="fas fa-lg">
                {{ ($shipping->order) ? $shipping->order->name : null }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('shippings.phone') }}" theme="info" icon="fas fa-lg">
                {{ ($shipping->order) ? $shipping->order->phone : null }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('shippings.address') }}" theme="info" icon="fas fa-lg">
                {{ ($shipping->order) ?  $shipping->order->address : null }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('shippings.product') }}" theme="info" icon="fas fa-lg">
                {{ ($shipping->order) ? ($shipping->order->product->name.'('.$shipping->order->product->model.'}' }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('shippings.accessories') }}" theme="info" icon="fas fa-lg">
                {{ $shipping->order->product->accessory->name."(".$shipping->order->product->accessory->model.")" }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('shippings.extras') }}" theme="info" icon="fas fa-lg">
                @if ($shipping->order)
                    @foreach($shipping->order->extras as $extra)
                        {{ $extra->product->name."(".$order->product->model.")" }}
                    @endforeach
                @endif
        </x-adminlte>
        <x-adminlte-card title="{{ __('shippings.sales') }}" theme="info" icon="fas fa-lg">
                {{ $shipping->order->sales->name }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('shippings.flow') }}" theme="info" icon="fas fa-lg">
                {{ trans_choice('shippings.flows', $shipping->order->flow) }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('shippings.shipping_date') }}" theme="info" icon="fas fa-lg">
                {{ $shipping->shipping_date }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('shippings.completion_time') }}" theme="info" icon="fas fa-lg">
                {{ $shipping->completion_time }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('shippings.installer') }}" theme="info" icon="fas fa-lg">
                {{ $shipping->installer }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('shippings.creator') }}" theme="info" icon="fas fa-lg">
                {{ $shipping->creator->name }}
        </x-adminlte-card>
        @if (auth()->user()->rolo == App\Enums\UserRole::Administrator ||
             auth()->user()->role == App\Enums\UserRole::Operator ||
             auth()->user()->role == App\Enums\UserRole::Accounter ||
             auth()->user()->role == App\Enums\UserRole::Installer)
        <x-adminlte-card title="{{ __('shippings.shipment') }}" theme="info" icon="fas fa-lg">
              <button onClick="window.location='{{ route('orders.shipment', $shipping->order->id); }}'" >
                {{ __('shippings.shipment_button') }}
              </button>
        </x-adminlte-card>
        @endif
     </div>
   </div>
@endsection
