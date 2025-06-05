@extends('adminlte::page')

@section('title', __('allowances.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('allowances.GetAllowanceList') }}</h1>
@stop

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

@php
   $i = 1;
@endphp
@foreach($allowanceInfo->details() as $allowance)
    <div class="raw">
         <x-adminlte-card title="{{ __('allowances.GetAllowanceList') }} : 編號{{ $i }}" theme="info" icon="fas fa-lg">
             <p><strong>{{ __('allowances.IA_Allow_No') }} : </strong> {{ $allowance->IA_Allow_No }}</p>
             <p><strong>{{ __('allowances.IA_Date') }} : </strong> {{ $allowance->IA_Date }}</p>
             <p><strong>{{ __('allowances.IA_Tax_Type') }} : </strong>
                 {{ trans_choice('allowances.IA_Tax_Types', $allowance->IA_Tax_Type) }}</p>
             <p><strong>{{ __('allowances.IA_Send_Mail') }} : </strong> {{ $allowance->IA_Send_Mail }}</p>
             <p><strong>{{ __('allowances.IA_Identifier') }} : </strong> {{ $allowance->IA_Identifier }}</p>
             <p><strong>{{ __('allowances.IA_Invoice_No') }} : </strong> {{ $allowance->IA_Invoice_No }}</p>
             <p><strong>{{ __('allowances.IA_Send_Phone') }} : </strong> {{ $allowance->IA_Send_Phone }}</p>
             <p><strong>{{ __('allowances.IA_Tax_Amount') }} : </strong> {{ $allowance->IA_Tax_Amount }}</p>
             <p><strong>{{ __('allowances.IA_Upload_Date') }} : </strong> {{ $allowance->IA_Upload_Date }}</p>
             <p><strong>{{ __('allowances.IA_Total_Amount') }} : </strong> {{ $allowance->IA_Total_Amount }}</p>
             <p><strong>{{ __('allowances.IA_Upload_Status') }} : </strong>
                 {{ trans_choice('allowances.IA_Upload_Statuses', $allowance->IA_Upload_Status) }}</p>
             <p><strong>{{ __('allowances.IA_Invalid_Status') }} : </strong>
                 {{ trans_choice('allowances.IA_Invalid_Statuses', $allowance->IA_Invalid_Status) }}</p>
             <p><strong>{{ __('allowances.IIS_Customer_Name') }} : </strong> {{ $allowance->IIS_Customer_Name }}</p>
             <p><strong>{{ __('allowances.IA_Check_Send_Mail') }} : </strong>
                 {{ $allowance->IA_Check_Send_Mail }}</p>
             <p><strong>{{ __('allowances.IA_Total_Tax_Amount') }} : </strong> {{ $allowance->IA_Total_Tax_Amount }}</p>
             <p><strong>{{ __('allowances.IA_Invoice_Issue_Date') }} : </strong> {{ $allowance->IA_Invoice_Issue_Date }}</p>
             <table border="2" width="60%">
                 <thead align="center">
                     <th>{{ __('allowances.ItemSeq') }}</th>
                     <th>{{ __('allowances.ItemName') }}</th>
                     <th>{{ __('allowances.ItemPrice') }}</th>
                     <th>{{ __('allowances.ItemCount') }}</th>
                     <th>{{ __('allowances.ItemWord') }}</th>
                     <th>{{ __('allowances.ItemAmount') }}</th>
                     <th>{{ __('allowances.ItemRateAmt') }}</th>
                     <th>{{ __('allowances.ItemTaxType') }}</th>
                 </thead>
                 @foreach($allowance->Items as $item)
                 <tr align="center">
                     <td>{{ $item->ItemSeq }}</td>
                     <td>{{ $item->ItemName }}</td>
                     <td>{{ $item->ItemPrice }}</td>
                     <td>{{ $item->ItemCount }}</td>
                     <td>{{ $item->ItemWord }}</td>
                     <td>{{ $item->ItemAmount }}</td>
                     <td>{{ $item->ItemRateAmt }}</td>
                     <td>{{ trans_choice('allowances.ItemTaxTypes', $item->ItemTaxType) }}</td>
                 </tr>
                 @endforeach
             </table>
         </x-adminlte>
    </div>
@php
    $i++;
@endphp
@endforeach

@endsection
