@extends('adminlte::page')

@section('title', __('massorders.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('massorders.header') }}</h1>
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
            <td><x-adminlte-card title="{{ __('massorders.cname') }}" theme="info" icon="fas fa-lg">
                {{ $massOrder->cname }}
            </x-adminlte></td>
            <td><x-adminlte-card title="{{ __('massorders.phone') }}" theme="warning" icon="fas fa-lg">
                {{ $massOrder->phone }}
            </x-adminlte-card></td>
        </tr>
        <tr>
            <td><x-adminlte-card title="{{ __('massorders.line_id') }}" theme="info" icon="fas fa-lg">
                {{ $massOrder->line_id }}
            </x-adminlte></td>
            <td><x-adminlte-card title="{{ __('massorders.email') }}" theme="warning" icon="fas fa-lg">
                {{ $massOrder->email }}
            </x-adminlte-card></td>
        </tr>
        <tr>
            <td><x-adminlte-card title="{{ __('massorders.cid') }}" theme="info" icon="fas fa-lg">
                {{ $massOrder->cid }}
            </x-adminlte></td>
            <td><x-adminlte-card title="{{ __('massorders.invoice') }}" theme="warning" icon="fas fa-lg">
                {{ $massOrder->invoice }}
            </x-adminlte-card></td>
        </tr>
        <tr>
            <td><x-adminlte-card title="{{ __('massorders.address') }}" theme="info" icon="fas fa-lg">
                {{ $massOrder->address }}
            </x-adminlte></td>
        </tr>
        <tr>
            <td><x-adminlte-card title="{{ __('massorders.memo') }}" theme="warning" icon="fas fa-lg">
                <pre>{{ $massOrder->memo }}</pre>
            </x-adminlte-card></td>
        </tr>
        <tr>
            <td colspan="2"><x-adminlte-card title="{{ __('massorders.products') }}" theme="primary" icon="fas fa-lg">
            </x-adminlte></td>
        </tr>
      </table>
      </div>
   </div>
@endsection
