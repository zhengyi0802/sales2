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
        <table class="col-xs-12 col-sm-12 col-md-12">
          <tr>
             <td><x-adminlte-card title="{{ __('productModels.name') }}" theme="info" icon="fas fa-lg">
                {{ $productModel->name }}
             </x-adminlte></td>
             <td><x-adminlte-card title="{{ __('productModels.model') }}" theme="info" icon="fas fa-lg">
                {{ $productModel->model }}
             </x-adminlte></td>
             <td><x-adminlte-card title="{{ __('productModels.price') }}" theme="info" icon="fas fa-lg">
                {{ "NTD ".$productModel->price }}
             </x-adminlte></td>
          </tr>
          <tr>
             <td><x-adminlte-card title="{{ __('productModels.catagory') }}" theme="info" icon="fas fa-lg">
                {{ $productModel->catagory->name }}
             </x-adminlte></td>
             <td><x-adminlte-card title="{{ __('productModels.vendor') }}" theme="info" icon="fas fa-lg">
                {{ $productModel->vendor->company }}
             </x-adminlte></td>
             <td><x-adminlte-card title="{{ __('productModels.accessories') }}" theme="info" icon="fas fa-lg">
                {{ ($productModel->accessories == 0) ? "--------" : $productModel->accessory->name."(".$productModel->accessory->model.")" }}
             </x-adminlte></td>
          </tr>
        </table>
        <x-adminlte-card title="{{ __('productModels.briefs') }}" theme="info" icon="fas fa-lg">
                <table>
                  @foreach(json_decode($productModel->briefs) as $brief)
                      <tr><td>{{ $brief }}</td></tr>
                  @endforeach
                </table>
        </x-adminlte>
        <x-adminlte-card title="{{ __('productModels.specifications') }}" theme="info" icon="fas fa-lg">
                <table>
                    @foreach(json_decode($productModel->specifications) as $specification)
                        <tr><td>{{ $specification }}</td></tr>
                    @endforeach
                </table>
        </x-adminlte>
        <x-adminlte-card title="{{ __('productModels.descriptions') }}" theme="info" icon="fas fa-lg">
                <pre>{{ $productModel->descriptions }}</pre>
        </x-adminlte>
        <table class="col-xs-12 col-sm-12 col-md-12">
          <tr>
             <td><x-adminlte-card title="{{ __('productModels.is_accessories') }}" theme="info" icon="fas fa-lg">
                {{ $productModel->is_accessories ? __('tables.yes') : __('tables.no') }}
             </x-adminlte></td>
             <td><x-adminlte-card title="{{ __('productModels.extras') }}" theme="info" icon="fas fa-lg">
                {{ $productModel->extra ? __('tables.yes') : __('tables.no') }}
             </x-adminlte></td>
             <td><x-adminlte-card title="{{ __('productModels.creator') }}" theme="warning" icon="fas fa-lg">
                {{ $productModel->creator->name }}
             </x-adminlte-card></td>
          </tr>
        </table>
     </div>
   </div>
@endsection
