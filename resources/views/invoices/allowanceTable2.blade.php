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

<x-adminlte-datatable id="allowancebycollegate-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($allowancebycollegiates as $allowancebycollegiate)
    <tr>
      <td>{{ $allowancebycollegiate->id }}</td>
      <td>{{ $allowancebycollegiate->invoice_no }}</td>
      <td>{{ $allowancebycollegiate->temp_date }}</td>
      <td>{{ $allowancebycollegiate->allowance_no }}</td>
      <td>{{ $allowancebycollegiate->allowance_amount }}</td>
      <td>{{ $allowancebycollegiate->invalid_flag ? __('invoices.invalid') : __('invoices.valid') }}</td>
      <td>
        <x-adminlte-button theme="danger" title="{{ __('allowances.AllowanceInvalidByCollegiate') }}" icon="fa fa-lg fa-fw fa-trash"
          onClick="window.location='{{ route('invoices.AllowanceInvalidByCollegiate', ['id' => $allowancebycollegiate->id])  }}'" >
        </x-adminlte-button>
        <x-adminlte-button theme="primary" title="{{ __('allowances.GetAllowanceList') }}" icon="fa fa-lg fa-fw fa-pen"
          onClick="window.location='{{ route('invoices.GetAllowanceList', ['id' => $allowancebycollegiate->id])  }}'" >
        </x-adminlte-button>
      </td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
