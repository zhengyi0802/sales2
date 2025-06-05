@php
$heads = [
    ['label' =>__('invoices.id'), 'width' => 10],
    __('invoices.invoice_no'),
    __('invoices.invoice_date'),
    __('invoices.order_id'),
    __('invoices.random_number'),
    __('invoices.status'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 20],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [ null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="delayissue-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($delayissues as $delayissue)
    <tr>
      <td>{{ $delayissue->id }}</td>
      <td>{{ $delayissue->invoice_no }}</td>
      <td>{{ $delayissue->invoice_date }}</td>
      <td>{{ $delayissue->recordno() }}</td>
      <td>{{ $delayissue->random_number }}</td>
      <td>{{ $delayissue->invalid_flag ? __('invoices.invalid') : __('invoices.valid') }}</td>
      <td>
        <x-adminlte-button theme="secondary" title="{{ __('issues.TriggerIssue') }}" icon="fa fa-lg fa-fw fa-cog"
          onClick="window.location='{{ route('invoices.TriggerIssue', ['id' => $delayissue->id])  }}'" >
        </x-adminlte-button>
        <x-adminlte-button theme="primary" title="{{ __('issues.EditDelayIssue') }}" icon="fa fa-lg fa-fw fa-pen"
          onClick="window.location='{{ route('invoices.edit_issue', ['id' => $delayissue->id])  }}'" >
        </x-adminlte-button>
        <x-adminlte-button theme="danger" title="{{ __('issues.CancelDelayIssue') }}" icon="fa fa-lg fa-fw fa-trash"
          onClick="window.location='{{ route('invoices.CancelDelayIssue', ['id' => $delayissue->id])  }}'" >
        </x-adminlte-button>
      </td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
