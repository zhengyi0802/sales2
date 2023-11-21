@extends('adminlte::page')

@section('title', __('productModels.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('productModels.header') }}</h1>
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
        <x-adminlte-card title="{{ __('productModels.name') }}" theme="info" icon="fas fa-lg">
                {{ $productModel->name }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('productModels.creator') }}" theme="info" icon="fas fa-lg">
                {{ $productModel->creator->name }}
        </x-adminlte-card>
     </div>
   </div>
@endsection
