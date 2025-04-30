@extends('adminlte::page')

@section('title', __('processes.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('processes.header') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ __('processes.success') }}</p>
        </div>
    @endif
    @if ($message = Session::get('insert-error'))
        <div class="alert alert-danger">
            <p>{{ __('processes.phone-error') }}</p>
        </div>
    @endif
@endsection

@section('content')

<style>
  div.content {
      width            : 100%;
  }
  div.block {
      border           : 1px solid blue;
      border-radius    : 10px;
      margin-top       : 4px;
      margin-bottom    : 4px;
      background-color : white;
  }
  p.title {
      margin-left : 10px;
  }
  p.result {
      margin-left : 30px;
  }
</style>
  <div class="card col-md-2">
      <a class="btn btn-success" href="{{ route('eapplies.edit', $process->eapply->id) }}">{{ __('processes.eapply_button') }}</a>
  </div>

  <div class="content">
     <form id="process-form" action="{{ route('processes.update', $process->id) }}" method="POST">
         @method('PUT')
         @csrf
         <div class="block">
           <p class="title"><strong>{{ __('processes.apply_id') }} :</strong></p>
           <p class="result">{{ $process->apply_id }}</p>
         </div>
         <div class="block">
           <p class="title"><strong>{{ __('processes.amount_id') }} :</strong></p>
           <p class="result">{{ $process->amount_id }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('processes.name') }} :</strong></p>
            <p class="result">{{ $process->name }}</p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('processes.phone') }} :</strong></p>
            <p class="result">{{ $process->phone }}</p>
         </div>
          <div class="block">
            <p class="title"><strong>{{ __('processes.address') }} :</strong></p>
            <p class="result">{{ $process->address }}</p>
          </div>
          <div class="block">
            <p class="title"><strong>{{ __('processes.project') }} :</strong></p>
            <p class="result">{{ $process->project }}</p>
          </div>
          <div class="block">
           <p class="title"><strong>{{ __('processes.flow') }} :</strong></p>
           <p class="result">
              <select id="flow" name="flow" disabled }}>
                <option value="7" {{ ($process->flow == 7) ? "selected" : null }}>{{ trans_choice('processes.flows', 7) }}</option>
                <option value="11" {{ ($process->flow == 11) ? "selected" : null }}>{{ trans_choice('processes.flows', 11) }}</option>
                <option value="12" {{ ($process->flow == 12) ? "selected" : null }}>{{ trans_choice('processes.flows', 12) }}</option>
                <option value="13" {{ ($process->flow == 13) ? "selected" : null }}>{{ trans_choice('processes.flows', 13) }}</option>
                <option value="14" {{ ($process->flow == 14) ? "selected" : null }}>{{ trans_choice('processes.flows', 14) }}</option>
              </select>
           </p>
          </div>
          <div class="block">
           <p class="title"><strong>{{ __('processes.memo') }} :</strong></p>
           <p class="result"><textarea name="memo" class="col-md-12" >{{ $process->memo }}</textarea></p>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary" disabled>{{ __('tables.submit') }}</button>
          </div>
     </form>
  </div>
@endsection
