@extends('adminlte::page')

@section('title', __('users.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('users.header') }}</h1>
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
        <x-adminlte-card title="{{ __('users.account') }}" theme="info" icon="fas fa-lg">
                {{ $user->account }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('users.name') }}" theme="info" icon="fas fa-lg">
                {{ $user->name }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('users.phone') }}" theme="info" icon="fas fa-lg">
                {{ $user->phone }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('users.line_id') }}" theme="info" icon="fas fa-lg">
                {{ $user->line_id }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('users.email') }}" theme="info" icon="fas fa-lg">
                {{ $user->email }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('users.address') }}" theme="info" icon="fas fa-lg">
                {{ $user->address }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('users.role') }}" theme="info" icon="fas fa-lg">
                {{ trans_choice('users.roles', $user->role) }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('users.creator') }}" theme="info" icon="fas fa-lg">
                {{ $user->creator->name }}
        </x-adminlte-card>
     </div>
   </div>
@endsection
