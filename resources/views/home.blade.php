@extends('adminlte::page')

@section('title', __('home.title'))

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop
<style>
   .num {
          font-size:24pt;
        }
  .cell {
          text-align:center;
        }
  .btnd {
          border-radius: 8px;
        }
</style>
@section('content')
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
    @if (auth()->user()->role == App\Enums\UserRole::Sales ||
         auth()->user()->role == App\Enums\UserRole::Reseller)
         @if (false)
         <x-adminlte-card title="{{ __('saleses.sales_link') }}" theme="info" icon="fas fa-lg">
                <span id="url">{{ __('saleses.sales_http').auth()->user()->sales->id }}</span>
                <a href="#" onclick="CopyToClipboard('url');return false;">{{ __('tables.copylink') }}</a><br>
         </x-adminlte>
         @else
         <x-adminlte-card title="{{ __('saleses.apply_link') }}" theme="info" icon="fas fa-lg">
                <span id="url">{{ __('saleses.apply_http').auth()->user()->sales->id }}</span>
                <a href="#" onclick="CopyToClipboard('url');return false;">{{ __('tables.copylink') }}</a><br>
         </x-adminlte>
         @endif
    @endif
        <table class="col-xs-12 col-sm-12 col-md-12">
         @if(auth()->user()->role != App\Enums\UserRole::Installer &&
             auth()->user()->role != App\Enums\UserRole::Accounter)
         <tr>
            <td class="cell">
               <x-adminlte-card title="{{ __('home.unhandled') }}" theme="info" icon="fas fa-lg">
                  <span class="num">{{ $data['unhandled'] }}</span><br>
                  <button class="btnd btn-info" onClick="window.location='{{ route('orders.index', ['flow' => '1']); }}'" >
                     {{ __('tables.details') }}
                  </button>
               </x-adminlte>
            </td>
            <td class="cell">
               <x-adminlte-card title="{{ __('home.contacted') }}" theme="info" icon="fas fa-lg">
                  <span class="num">{{ $data['contacted'] }}</span><br>
                  <button class="btnd btn-info"onClick="window.location='{{ route('orders.index', ['flow' => '2']); }}'" >
                     {{ __('tables.details') }}
                  </button>
               </x-adminlte-card>
            </td>
            <td class="cell">
               <x-adminlte-card title="{{ __('home.confirmed') }}" theme="info" icon="fas fa-lg">
                  <span class="num">{{ $data['confirmed'] }}</span><br>
                  <button class="btnd btn-info" onClick="window.location='{{ route('orders.index', ['flow' => '3']); }}'" >
                     {{ __('tables.details') }}
                  </button>
               </x-adminlte>
            </td>
         </tr>
         @endif
         <tr>
            <td class="cell">
               <x-adminlte-card title="{{ __('home.shippings') }}" theme="primary" icon="fas fa-lg">
                  <span class="num">{{ $data['shippings'] }}</span><br>
                  <button class="btnd btn-info" onClick="window.location='{{ route('orders.index', ['flow' => '4']); }}'" >
                     {{ __('tables.details') }}
                  </button>
               </x-adminlte-card>
             </td>
             <td class="cell">
               <x-adminlte-card title="{{ __('home.completions') }}" theme="success" icon="fas fa-lg">
                  <span class="num">{{ $data['completions'] }}</span><br>
                  <button class="btnd btn-info" onClick="window.location='{{ route('orders.index', ['flow' => '5']); }}'" >
                     {{ __('tables.details') }}
                  </button>
               </x-adminlte>
             </td>
             <td class="cell">
               <x-adminlte-card title="{{ __('home.finished') }}" theme="success" icon="fas fa-lg">
                  <span class="num">{{ $data['finished'] }}</span><br>
                  <button class="btnd btn-info" onClick="window.location='{{ route('orders.index', ['flow' => '6']); }}'" >
                     {{ __('tables.details') }}
                  </button>
               </x-adminlte-card>
             </td>
         </tr>
         <tr>
             <td class="cell">
               <x-adminlte-card title="{{ __('home.chargebacks') }}" theme="danger" icon="fas fa-lg">
                  <span class="num">{{ $data['chargebacks'] }}</span><br>
                  <button class="btnd btn-info" onClick="window.location='{{ route('orders.index', ['flow' => '7']); }}'" >
                     {{ __('tables.details') }}
                  </button>
               </x-adminlte-card>
             </td>
          @if (auth()->user()->role == App\Enums\UserRole::Administrator)
            <td class="cell">
               <x-adminlte-card title="{{ __('home.disabled') }}" theme="warning" icon="fas fa-lg">
                  <span class="num">{{ $data['disabled'] }}</span><br>
                  <button class="btnd btn-info" onClick="window.location='{{ route('orders.index', ['flow' => '-1']); }}'" >
                     {{ __('tables.details') }}
                  </button>
               </x-adminlte-card>
            </td>
         @endif
         </tr>
      </table>
     </div>
<script>
    function CopyToClipboard(id)
    {
        var r = document.createRange();
        r.selectNode(document.getElementById(id));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(r);
        document.execCommand('copy');
        window.getSelection().removeAllRanges();
    }
</script>
@stop
