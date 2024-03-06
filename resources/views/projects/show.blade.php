@extends('adminlte::page')

@section('title', __('projects.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('projects.header') }}</h1>
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
        <x-adminlte-card title="{{ __('projects.name') }}" theme="info" icon="fas fa-lg">
                {{ $project->name }}
        </x-adminlte>
        <x-adminlte-card title="{{ __('projects.details') }}" theme="info" icon="fas fa-lg">
                <pre>{{ $project->details }}</pre>
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('projects.extras') }}" theme="primary" icon="fas fa-lg">
                @if ($project->gifts() != null)
                  @foreach($project->gifts() as $gift)
                     {{ $gift->name.'('.$gift->model.')' }}
                  @endforeach
                @endif
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('projects.salesing') }}" theme="warning" icon="fas fa-lg">
                {{ $project->salesing ? __('tables.enabled') : __('tables.disabled') }}
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('projects.creator') }}" theme="warning" icon="fas fa-lg">
                {{ $project->creator->name }}
        </x-adminlte-card>
     </div>
   </div>
@endsection
