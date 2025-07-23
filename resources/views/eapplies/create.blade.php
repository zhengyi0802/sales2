@extends('adminlte::page')

@section('title', __('eapplies.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('eapplies.header') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ __('eapplies.success') }}</p>
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
  div.block1 {
      border           : 1px solid blue;
      border-radius    : 10px;
      margin-top       : 4px;
      margin-bottom    : 4px;
      background-color : yellow;
  }
  p.title {
      margin-left : 10px;
  }
  p.result {
      margin-left : 30px;
  }
</style>

  <div class="content">
     <div class="block">
        <p>{{ Session::get('error') }}</p>
     </div>
     <form id="eapply-form" action="{{ route('eapplies.store') }}" method="POST">
         @csrf
         <div class="block">
            <p class="title"><strong>{{ __('eapplies.reseller') }} :</strong></p>
            @if ($reseller != null)
                <input type="hidden" name="reseller_id" value="{{ $reseller->id }}">
                <p class="result">{{ $reseller->name }}</p>
            @else
                <p class="result">
                <select name="reseller_id" >
                    @foreach($resellers as $res)
                        <option value="{{ $res->id }}">{{ $res->name }}</option>
                    @endforeach
                </select></p>
            @endif
         </div>

         <div class="block">
            <p class="title"><strong>{{ __('eapplies.name') }} :</strong></p>
            <p class="result"><input type="text"  name="name" class="form-control" ></p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('eapplies.line_id') }} :</strong></p>
            <p class="result"><input type="text" name="line_id" class="form-control" ></p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('eapplies.email') }} :</strong></p>
            <p class="result"><input type="text" name="email" class="form-control" ></p>
         </div>
         <div class="block">
            <p class="title"><strong>{{ __('eapplies.phone') }} :</strong></p>
            <p class="result"><input type="text" name="phone" class="form-control" ></p>
         </div>
          <div class="block">
            <p class="title"><strong>{{ __('eapplies.address') }} :</strong></p>
            <p class="result"><input type="text" name="address" class="form-control" ></p>
          </div>
          <div class="block">
            <p class="title"><strong>{{ __('eapplies.project') }} :</strong></p>
            <p class="result">
               <select id="project_id" name="project_id" onchange="checkProject(this)">
                 @foreach($dprojects as $dproject)
                     <option value="{{ $dproject->id }}" >{{ $dproject->name }}</option>
                 @endforeach
               </select>
              </p>
          </div>
          <div class="block">
              <p class="title"><strong>{{ __('eapplies.doorlock').__('eapplies.amount') }} :</strong> : </p>
              <p class="result"><input type="number" name="amount" class="form-control" value="1" ></p>
          </div>
          <div class="block">
              <p class="title"><strong>{{ __('eapplies.payment') }} :</strong></p>
              <p class="result"><input type="radio" name="payment" value="0" >{{ __('eapplies.payment_unset') }}</p>
          </div>
          <div class="block">
             <p class="title"><strong>{{ __('eapplies.memo') }} :</strong></p>
             <p class="result"><textarea name="memo" class="col-md-12" ></textarea></p>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
          </div>
     </form>
  </div>
@endsection
