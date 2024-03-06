@extends('adminlte::page')

@section('title', __('customers.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('customers.header') }}</h1>
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
        <x-adminlte-card title="{{ __('customers.name') }}" theme="info" icon="fas fa-lg">
                {{ $customer->name }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('customers.phone') }}" theme="info" icon="fas fa-lg">
                {{ $customer->phone }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('customers.line_id') }}" theme="info" icon="fas fa-lg">
                {{ $customer->line_id }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('customers.email') }}" theme="info" icon="fas fa-lg">
                {{ $customer->email }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('customers.address') }}" theme="info" icon="fas fa-lg">
                {{ $customer->address }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('customers.pid') }}" theme="info" icon="fas fa-lg">
                {{ $customer->pid }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('customers.sales') }}" theme="info" icon="fas fa-lg">
                {{ $customer->sales->name }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('customers.creator') }}" theme="warning" icon="fas fa-lg">
                {{ $customer->creator->name }}
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('customers.orders') }}" theme="info" icon="fas fa-lg">
                @include('customers.orders.table')
        </x-adminlte-card>
     </div>
   </div>
@endsection
