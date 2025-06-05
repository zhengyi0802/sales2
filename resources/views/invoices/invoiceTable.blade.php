@php
$heads = [
    __('invoices.IIS_Number'),
    __('invoices.IIS_Relate_Number'),
    __('invoices.IIS_Identifier'),
    __('invoices.IIS_Tax_Amount'),
    __('invoices.IIS_Sales_Amount'),
    __('invoices.IIS_Create_Date'),
    __('invoices.IIS_Issue_Status'),
    __('invoices.IIS_Invalid_Status'),
    __('invoices.IIS_Remain_Allowance_Amt'),
    __('invoices.IIS_Print_Flag'),
    __('invoices.IIS_Carrier_Type'),
    __('invoices.IIS_Carrier_Num'),
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, null, null, null, null, null],
    'language' => [ 'url' => __('tables.language_url') ],
];
@endphp

<x-adminlte-datatable id="issue-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" class="table-sm"
   striped hoverable bordered with-buttons>
  @foreach($invoiceData as $invoice)
    <tr>
      <td>{{ $invoice['IIS_Number'] }}</td>
      <td>{{ $invoice['IIS_Relate_Number'] }}</td>
      <td>{{ ($invoice['IIS_Identifier'] == '00000000') ? null : $invoice['IIS_Identifier'] }}</td>
      <td>{{ $invoice['IIS_Tax_Amount'] }}</td>
      <td>{{ $invoice['IIS_Sales_Amount'] }}</td>
      <td>{{ $invoice['IIS_Create_Date'] }}</td>
      <td>{{ trans_choice('invoices.IIS_Issue_Statuses', $invoice['IIS_Issue_Status']) }}</td>
      <td>{{ trans_choice('invoices.IIS_Invalid_Statuses', $invoice['IIS_Invalid_Status']) }}</td>
      <td>{{ $invoice['IIS_Remain_Allowance_Amt'] }}</td>
      <td>{{ trans_choice('invoices.IIS_Print_Flags', $invoice['IIS_Print_Flag']) }}</td>
      <td>{{ trans_choice('invoices.IIS_Carrier_Types', $invoice['IIS_Carrier_Type']) }}</td>
      <td>{{ $invoice['IIS_Carrier_Num'] }}</td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
