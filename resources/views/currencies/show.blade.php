@extends('adminlte::page')

@section('title', __('currencies.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('currencies.header') }}</h1>
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
            <td><x-adminlte-card title="{{ __('currencies.name') }}" theme="info" icon="fas fa-lg">
                {{ $currency->currency_name }}
            </x-adminlte></td>
            <td><x-adminlte-card title="{{ __('currencies.rate') }}" theme="warning" icon="fas fa-lg">
                {{ $currency->currency_rate }}
            </x-adminlte-card></td>
        </tr>
      </table>
      </div>
   </div>
@endsection
