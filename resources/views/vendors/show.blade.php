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
        <table>
          <tr>
             <td><x-adminlte-card title="{{ __('vendors.company') }}" theme="info" icon="fas fa-lg">
                    {{ $vendor->company }}
             </x-adminlte></td>
             <td><x-adminlte-card title="{{ __('vendors.country') }}" theme="info" icon="fas fa-lg">
                    {{ $vendor->country }}
             </x-adminlte></td>
             <td><x-adminlte-card title="{{ __('vendors.creator') }}" theme="warning" icon="fas fa-lg">
                    {{ $vendor->creator->name }}
             </x-adminlte-card></td>
          </tr>
          <tr>
             <td colspan="3"><x-adminlte-card title="{{ __('vendors.memo') }}" theme="info" icon="fas fa-lg">
                    <pre>{{ $vendor->memo }}</pre>
             </x-adminlte></td>
          <tr>
             <td colspan="3"><x-adminlte-card title="{{ __('vendors.products') }}" theme="primary" icon="fas fa-lg">
                    @include('vendors.productmodels.table')
             </x-adminlte></td>
          </tr>
        </table>
     </div>
   </div>
@endsection
