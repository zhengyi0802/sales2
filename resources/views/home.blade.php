@extends('adminlte::page')

@section('title', __('home.title'))

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <table class="col-xs-12 col-sm-12 col-md-12">
         @if(auth()->user()->role != App\Enums\UserRole::Installer &&
             auth()->user()->role != App\Enums\UserRole::Accounter)
         <tr>
            <td>
               <x-adminlte-card title="{{ __('home.unhandled') }}" theme="info" icon="fas fa-lg">
                  {{ $data['unhandled'] }}
               </x-adminlte>
            </td>
            <td>
               <x-adminlte-card title="{{ __('home.contacted') }}" theme="info" icon="fas fa-lg">
                  {{ $data['contacted'] }}
               </x-adminlte-card>
            </td>
            <td>
               <x-adminlte-card title="{{ __('home.confirmed') }}" theme="info" icon="fas fa-lg">
                  {{ $data['confirmed'] }}
               </x-adminlte>
            </td>
         </tr>
         @endif
         <tr>
            <td>
               <x-adminlte-card title="{{ __('home.shippings') }}" theme="primary" icon="fas fa-lg">
                  {{ $data['shippings'] }}
               </x-adminlte-card>
             </td>
             <td>
               <x-adminlte-card title="{{ __('home.completions') }}" theme="success" icon="fas fa-lg">
                  {{ $data['completions'] }}
               </x-adminlte>
             </td>
             <td>
               <x-adminlte-card title="{{ __('home.chargebacks') }}" theme="danger" icon="fas fa-lg">
                  {{ $data['chargebacks'] }}
               </x-adminlte-card>
             </td>
         </tr>
         @if (auth()->user()->role == App\Enums\UserRole::Administrator)
         <tr>
            <td>
               <x-adminlte-card title="{{ __('home.disabled') }}" theme="warning" icon="fas fa-lg">
                  {{ $data['disabled'] }}
               </x-adminlte-card>
            </td>
         </tr>
         @endif
      </table>
     </div>
@stop
