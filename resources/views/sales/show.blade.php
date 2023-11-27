@extends('adminlte::page')

@section('title', __('saleses.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('saleses.header') }}</h1>
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
        <x-adminlte-card title="{{ __('saleses.name') }}" theme="info" icon="fas fa-lg">
                {{ $sales->name }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('saleses.account') }}" theme="info" icon="fas fa-lg">
                {{ $sales->user->account }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('saleses.phone') }}" theme="info" icon="fas fa-lg">
                {{ $sales->phone }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('saleses.line_id') }}" theme="info" icon="fas fa-lg">
                {{ $sales->line_id }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('saleses.email') }}" theme="info" icon="fas fa-lg">
                {{ $sales->email }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('saleses.company') }}" theme="info" icon="fas fa-lg">
                {{ $sales->company }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('saleses.job') }}" theme="info" icon="fas fa-lg">
                {{ $sales->job }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('saleses.address') }}" theme="info" icon="fas fa-lg">
                {{ $sales->address }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('saleses.identity') }}" theme="info" icon="fas fa-lg">
                {{ ($sales->user->role == App\Enums\UserRole::Sales) ? __('saleses.id_sales') : __('saleses.id_reseller') }}
        </x-adminlte>
     </div>
   </div>
@endsection
