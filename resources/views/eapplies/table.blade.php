@php
$heads = [
    ['label' =>__('eapplies.id'), 'width' => 10],
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
    'columns' => [null, null, null, null, null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="eapply-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($eapplies as $eapply)
    <tr class="{{ $eapply->status ? null : "bg-gray"}}">
      <td>{{ $eapply->id }}</td>
      <td>{{ $eapply->reseller->name }}</td>
      <td>{{ $eapply->name }}</td>
      @if (auth()->user()->role == App\Enums\UserRole::ShareHolder)
           <td>{{ str_split($eapply->phone, 5)[0].'****' }}</td>
      @else
           <td>{{ $eapply->phone }}</td>
      @endif
      <td>{{ $eapply->project->name }}</td>
      <td>{{ ($eapply->payment == 11) ? __('eapplies.payment_third') : __('eapplies.payment_credit') }}</td>
      <td>{{ $eapply->total }}</td>
      <td>{{ $eapply->paid }}</td>
      <td>{{ $eapply->remain }}</td>
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

