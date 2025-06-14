@php
$heads = [
    ['label' =>__('eapplies.id'), 'width' => 10],
    __('eapplies.trade_no'),
    __('eapplies.reseller'),
    __('eapplies.name'),
    __('eapplies.phone'),
    __('eapplies.project'),
    __('eapplies.payment'),
    __('eapplies.total'),
    __('eapplies.paid'),
    __('eapplies.remain'),
    __('eapplies.flow'),
    __('eapplies.created_at'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp
<div class="row">
    <div class="col-md-4">{{ __('tables.table-bgcolor') }}</div>
    <div class="col-md-4" style="background-color:green;color:white;">{{ __('tables.bg-green') }}</div>
    <div class="col-md-4" style="background-color:yellow">{{ __('tables.bg-yellow') }}</div>
</div>
<x-adminlte-datatable id="eapply-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($eapplies as $eapply)
    @if ($eapply->ecpayResult != null)
    <tr class="{{ $eapply->status ? 'bg-green' : 'bg-gray' }}">
    @elseif ($eapply->ecpayInfo != null)
    <tr class="{{ $eapply->status ? 'bg-yellow' : 'bg-gray' }}">
    @else
    <tr class="{{ $eapply->status ? null : 'bg-gray' }}">
    @endif
      <td>{{ $eapply->id }}</td>
      <td>{{ $eapply->trade_no }}</td>
      <td>{{ isset($eapply->reseller) ? $eapply->reseller->name : null }}</td>
      <td>{{ $eapply->name ?? ''}}</td>
      @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
           <td>{{ str_split($eapply->phone, 5)[0].'****' }}</td>
      @else
           <td>{{ $eapply->phone }}</td>
      @endif
      <td>{{ isset($eapply->project) ? $eapply->project->name : null }}</td>
      <td>{{ ($eapply->payment == 11) ? __('eapplies.payment_third') : __('eapplies.payment_credit') }}</td>
      <td>{{ __('currencies.NTD').$eapply->total.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$eapply->paid.__('currencies.ntd_unit') }}</td>
      <td>{{ __('currencies.NTD').$eapply->remain.__('currencies.ntd_unit') }}</td>
      <td>{{ ($eapply->flow1 > 0) ? trans_choice('eapplies.flows', $eapply->flow1) : trans_choice('eapplies.flows', $eapply->flow) }} </td>
      <td>{{ $eapply->created_at ?? '' }}</td>
      <td><nobr>
          <form name="eapply-delete-form" action="{{ route('eapplies.destroy', $eapply->id); }}" method="POST">
            @csrf
            @method('DELETE')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('eapplies.edit', $eapply->id); }}'" >
              </x-adminlte-button>
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" onclick="return confirm('{{ __('tables.confirm_delete') }}');">
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

