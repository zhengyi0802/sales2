@extends('adminlte::page')

@section('title', __('catagories.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('catagories.header') }}</h1>
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
            <td><x-adminlte-card title="{{ __('catagories.name') }}" theme="info" icon="fas fa-lg">
                {{ $catagory->name }}
            </x-adminlte></td>
            <td><x-adminlte-card title="{{ __('catagories.creator') }}" theme="warning" icon="fas fa-lg">
                {{ $catagory->creator->name }}
            </x-adminlte-card></td>
        </tr>
        <tr>
            <td colspan="2"><x-adminlte-card title="{{ __('catagories.products') }}" theme="primary" icon="fas fa-lg">
                @include('catagories.productmodels.table')
            </x-adminlte></td>
        </tr>
      </table>
      </div>
   </div>
@endsection
