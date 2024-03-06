@extends('adminlte::page')

@section('title', __('inventories.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('inventories.header') }}</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
        <form action="{{ url('inventories/table') }}" method="GET" target="table">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group col-md-6">
                <strong>{{ __('inventories.product') }} :</strong>
                <select id="producr_id" name="product_id" onchange="this.form.submit()">
                      @foreach ($products as $product)
                         <option value="{{ $product->id }}" >{{ $product->model.'('.$product->name.')' }}</option>
                      @endforeach
                </select>
            </div>
        </div>
        </form>
    </div>
    <div class="row md-12">
      <iframe name="table" src="{{url('inventories/table')}}" frameborder="0" width="100%" onload='resizeIframe(this)'>Your browser isn't compatible</iframe>
    </div>
<script type="text/javascript">
  function resizeIframe(obj) {
     obj.style.height = 0;
     obj.style.height = obj.contentWindow.document.body.scrollHeight + 200 + 'px';
  }
</script>

@endsection
