@extends('adminlte::page')

@section('title', __('vendors.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('vendors.header') }}</h1>
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
        <x-adminlte-card title="{{ __('vendors.company') }}" theme="info" icon="fas fa-lg">
                {{ $vendor->company }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('vendors.country') }}" theme="info" icon="fas fa-lg">
                {{ $vendor->country }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('vendors.creator') }}" theme="info" icon="fas fa-lg">
                {{ $vendor->creator->name }}
        </x-adminlte-card>
     </div>
   </div>
@endsection
