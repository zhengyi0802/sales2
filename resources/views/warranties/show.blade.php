@extends('adminlte::page')

@section('title', __('warranties.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('warranties.header') }}</h1>
@stop
<style>
    div.upgrade {
        margin-bottom : 20px;
    }
</style>
@section('content')
    <div class="row">
      <table>
         <tr>
            <td><x-adminlte-card title="{{ __('warranties.name') }}" theme="info" icon="fas fa-lg">
              {{ $warranty->order()->name ?? '' }}
            </x-adminlte-card></td>
            <td><x-adminlte-card title="{{ __('warranties.phone') }}" theme="info" icon="fas fa-lg">
              {{ $warranty->order()->phone ?? '' }}
             </x-adminlte-card></td>
         </tr>
         <tr>
            <td colspan="2"><x-adminlte-card title="{{ __('warranties.address') }}" theme="info" icon="fas fa-lg">
              {{ $warranty->order()->address ?? '' }}
             </x-adminlte-card></td>
         </tr>
         <tr>
            <td><x-adminlte-card title="{{ __('warranties.model_id') }}" theme="info" icon="fas fa-lg">
              {{ $warranty->productModel()->model ?? '' }}
            </x-adminlte-card></td>
            <td><x-adminlte-card title="{{ __('warranties.android_id') }}" theme="info" icon="fas fa-lg">
              {{ $warranty->product->android_id ?? '' }}
             </x-adminlte-card></td>
         </tr>
         <tr>
            <td><x-adminlte-card title="{{ __('warranties.warranties_time') }}" theme="info" icon="fas fa-lg">
              {{ $warranty->register_time }}
            </x-adminlte-card></td>
            <td><x-adminlte-card title="{{ __('warranties.warranty_date') }}" theme="info" icon="fas fa-lg">
              {{ date('Y-m-d', strtotime('+3 years', strtotime($warranty->warranties_time))) }}
            </x-adminlte-card></td>
         </tr>
      </table>
    </div>
@endsection
