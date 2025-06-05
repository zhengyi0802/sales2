@php
$heads = [
    ['label' =>__('invoices.id'), 'width' => 10],
    __('allowances.invoice_no'),
    __('allowances.allowance_date'),
    __('allowances.allowance_no'),
    __('allowances.allowance_amount'),
    __('allowances.invalid_flag'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 20],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [ null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="allowance-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($allowances as $allowance)
    <tr>
      <td>{{ $allowance->id }}</td>
      <td>{{ $allowance->invoice_no }}</td>
      <td>{{ $allowance->date }}</td>
      <td>{{ $allowance->allowance_no }}</td>
      <td>{{ $allowance->allowance_amount }}</td>
      <td>{{ $allowance->invalid_flag ? __('invoices.invalid') : __('invoices.valid') }}</td>
      <td>
        <x-adminlte-button theme="danger" title="{{ __('allowances.AllowanceInvalid') }}" icon="fa fa-lg fa-fw fa-trash"
          onClick="window.location='{{ route('invoices.AllowanceInvalid', ['id' => $allowance->id])  }}'" >
        </x-adminlte-button>
        <x-adminlte-button theme="primary" title="{{ __('allowances.GetAllowanceList') }}" icon="fa fa-lg fa-fw fa-pen"
          onClick="window.location='{{ route('invoices.GetAllowanceList', ['id' => $allowance->id])  }}'" >
        </x-adminlte-button>
      </td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
