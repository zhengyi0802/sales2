@extends('adminlte::page')

@section('title', __('catagories.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('catagories.header') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>{{ __('tables.new') }}</h1>
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
<form id="import-form" action="{{ route('csvs.imports') }}" method="POST" enctype="multipart/form-data">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-4">
                <strong>{{ __('csvs.file') }} :<span class="must">{{ __('tables.must') }}</span></strong>
                <input type="file" name="file" accept=".csv">
            </div>
        </div>
        <table>
            <tr>
                <td><strong>{{ __('orders.sales') }} :<span class="must">{{ __('tables.must') }}</span></strong></td>
                <td><select id="sales_id" name="sales_id" >
                      @foreach ($sales as $s)
                         <option value="{{ $s->id }}" >{{ $s->name }}</option>
                      @endforeach
                </select></td>
           </tr>
           <tr>
                <td><strong>{{ __('csvs.project') }} :<span class="must">{{ __('tables.must') }}</span></strong></td>
                <td><select id="project_id" name="project_id" >
                      <option value="">--------</option>
                      @foreach ($projects as $project)
                         <option value="{{ $project->id }}" >{{ $project->name }}</option>
                      @endforeach
                </select></td>
           </tr>
           <tr>
                <td><strong>{{ __('csvs.product') }} :<span class="must">{{ __('tables.must') }}</span></strong></td>
                <td><select id="product_id" name="product_id" >
                      @foreach ($productModels as $product)
                         <option value="{{ $product->id }}" >{{ $product->name }}</option>
                      @endforeach
                </select></td>
            </tr>
            <tr class="form-group col-md-4">
                <td><strong>{{ __('csvs.extras') }} :</strong></td>
                <td><select id="extra_id" name="extra_id[]" multiple="multiple" size="10">
                      <option value="0">----------</option>
                      @foreach ($extras as $extra)
                         <option value="{{ $extra->id }}" >{{ $extra->name }}</option>
                      @endforeach
                </select></td>
            </div>
        </table>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
        </div>
    </div>
</form>

@endsection
