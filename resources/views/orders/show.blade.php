@extends('adminlte::page')

@section('title', __('orders.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('orders.header') }}</h1>
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
        <x-adminlte-card title="{{ __('orders.name') }}" theme="info" icon="fas fa-lg">
                {{ $order->name }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('orders.phone') }}" theme="info" icon="fas fa-lg">
                {{ $order->phone }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('orders.line_id') }}" theme="info" icon="fas fa-lg">
                {{ $order->line_id }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('orders.email') }}" theme="info" icon="fas fa-lg">
                {{ $order->email }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('orders.address') }}" theme="info" icon="fas fa-lg">
                {{ $order->address }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('orders.pid') }}" theme="info" icon="fas fa-lg">
                {{ $order->pid }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('orders.sales') }}" theme="info" icon="fas fa-lg">
                {{ $order->sales->name }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('orders.creator') }}" theme="info" icon="fas fa-lg">
                {{ $order->creator->name }}
        </x-adminlte-card>
     </div>
   </div>
@endsection
