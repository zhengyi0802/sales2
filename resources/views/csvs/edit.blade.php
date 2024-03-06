@extends('adminlte::page')

@section('title', __('catagories.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('catagories.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.edit') }}</h1>
            </div>
            @include('layouts.back')
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <style>
       .error {
          color       : red;
          margin-left : 5px;
          font-size   : 12px;
       }
       label.error {
          display     : inline;
       }
       span.must {
          color     : red;
          font-size : 12px;
       }
    </style>
    <form id="catagory-form" action="{{ route('catagories.update',$catagory->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('catagories.name') }} :</strong>
                    <input type="text" name="name" value="{{ $catagory->name }}" class="form-control">
                </div>
           </div>
           @if (auth()->user()->role == App\Enums\UserRole::Administrator)
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-md-4">
                    <strong>{{ __('catagories.status') }} :</strong>
                    <input type="checkbox" name="status" value="1" {{ $catagory->status ? "checked" : null }}>
                    <label for="status">{{ __('tables.enabled') }}</label>
                </div>
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
           </div>
           @endif
        </div>
    </form>

@endsection
