@extends('adminlte::page')

@section('title', __('invoices.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('issues.GetIssue') }}</h1>
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

  <div class="raw">
      <div class="col-xs-12 col-sm-12 col-md-12">
      <table class="col-md-12">
         <tr>
             <td  class="col-md-6"><strong>{{ __('issues.IIS_Number') }} :</strong></td>
             <td  class="col-md-6">{{ $issueInfo->details()->IIS_Number }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Relate_Number') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Relate_Number }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Customer_ID') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Customer_ID }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Identifier') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Identifier }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Customer_Name') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Customer_Name }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Customer_Addr') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Customer_Addr }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Customer_Phone') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Customer_Phone }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Customer_Email') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Customer_Email }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Clearance_Mark') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Clearance_Mark }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Type') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Type }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Category') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Category }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Tax_Type') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Tax_Type }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Tax_Rate') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Tax_Rate }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Tax_Amount') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Tax_Amount }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Sales_Amount') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Sales_Amount }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Check_Number') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Check_Number }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Carrier_Type') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Carrier_Type }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Carrier_Num') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Carrier_Num }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Love_Code') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Love_Code }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_IP') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_IP }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Create_Date') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Create_Date }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Issue_Status') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Issue_Status }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Invalid_Status') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Invalid_Status }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Upload_Status') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Upload_Status }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Upload_Date') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Upload_Date }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Turnkey_Status') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Turnkey_Status }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Remain_Allowance_Amt') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Remain_Allowance_Amt }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Print_Flag') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Print_Flag }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Award_Flag') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Award_Flag }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Award_Type') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Award_Type }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Random_Number') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->IIS_Random_Number }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.InvoiceRemark') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->InvoiceRemark }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.QRCode_Left') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->QRCode_Left }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.QRCode_Right') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->QRCode_Right }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.PosBarCode') }} :</strong></td>
            <td  class="col-md-6">{{ $issueInfo->details()->PosBarCode }}</td>
         </tr>
      </table>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         @include('invoices.issues.table3')
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
      @if ($issueInfo->details()->IIS_Customer_Email != null)
        <x-adminlte-button theme="primary" title="{{ __('issues.InvoiceNotify') }}" icon="fa fa-lg fa-fw fa-bell"
          onClick="window.location='{{ route('invoices.InvoiceNotify', ['invoice_no' => $issueInfo->invoice_no, 'email' => $issueInfo->details()->IIS_Customer_Email ])  }}'" >
        </x-adminlte-button>
      @endif
        <x-adminlte-button theme="primary" title="{{ __('issues.InvoicePrint') }}" icon="fa fa-lg fa-fw fa-print"
          onClick="window.location='{{ route('invoices.InvoicePrint', ['invoice_no' => $issueInfo->invoice_no, 'invoice_date' => $issueInfo->invoice_date ])  }}'" >
        </x-adminlte-button>
      </div>
  </div>
  <div class="raw">
      <h2>{{ __('issues.allowance') }}</h2>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <form name="allowanceForm" method="POST" action="{{ route('invoices.Allowance')  }}">
            @csrf
            <input type="hidden" name="id" value="{{ $issueInfo->id }}">
            <input type="hidden" name="AllowanceNotify" value="E">
            <div class="form col-md-12">
                <strong>{{ __('issues.AllowanceType') }} :</strong>
                <input type="radio" name="type" id="Allowance" value="1">
                <label for="Allowance">{{ __('issues.Allowance') }}</label>
                <input type="radio" name="type" id="AllowanceByCollegiate" value="2" checked>
                <label for="AllowanceByCollegiate">{{ __('issues.AllowanceByCollegiate') }}</label>
            </div>
            <div class="form col-md-12">
                <strong>{{ __('issues.NotifyMail') }} :</strong>
                <input type="text" class="form-group col-md-6" name="NotifyMail" value="{{ $issueInfo->details()->IIS_Customer_Email }}">
            </div>
            <div class="form col-md-12">
                <strong>{{ __('issues.AllowanceAmount') }} :</strong>
                <input type="number" class="form-group col-md-6" name="AllowanceAmount" value="0">
            </div>
            <div class="form col-md-12">
                <strong>{{ __('issues.AllowanceReason') }} :</strong>
                <input type="text" class="form-group col-md-6" name="Reason" value="">
            </div>
            <div class="form col-md-12">
            </div>
            <div class="form col-md-12">
                <button type="submit" class="btn btn-primary">{{ __('tables.submit') }}</button>
            </div>
        </form>
      </div>
  </div>
@endsection
