@extends('adminlte::page')

@section('title', __('invoices.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('issues.GetInvalid') }}</h1>
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
             <td  class="col-md-6">{{ $invalid->details()->IIS_Number }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Relate_Number') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Relate_Number }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Customer_ID') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Customer_ID }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Identifier') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Identifier }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Customer_Name') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Customer_Name }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Customer_Addr') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Customer_Addr }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Customer_Phone') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Customer_Phone }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Customer_Email') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Customer_Email }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Clearance_Mark') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Clearance_Mark }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Type') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Type }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Category') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Category }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Tax_Type') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Tax_Type }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Tax_Rate') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Tax_Rate }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Tax_Amount') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Tax_Amount }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Sales_Amount') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Sales_Amount }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Check_Number') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Check_Number }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Carrier_Type') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Carrier_Type }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Carrier_Num') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Carrier_Num }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Love_Code') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Love_Code }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_IP') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_IP }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Create_Date') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Create_Date }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Issue_Status') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Issue_Status }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Invalid_Status') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Invalid_Status }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Upload_Status') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Upload_Status }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Upload_Date') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Upload_Date }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Turnkey_Status') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Turnkey_Status }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Remain_Allowance_Amt') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Remain_Allowance_Amt }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Print_Flag') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Print_Flag }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Award_Flag') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Award_Flag }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Award_Type') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Award_Type }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.IIS_Random_Number') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->IIS_Random_Number }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.InvoiceRemark') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->InvoiceRemark }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.QRCode_Left') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->QRCode_Left }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.QRCode_Right') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->QRCode_Right }}</td>
         </tr>
         <tr>
            <td  class="col-md-6"><strong>{{ __('issues.PosBarCode') }} :</strong></td>
            <td  class="col-md-6">{{ $invalid->details()->PosBarCode }}</td>
         </tr>
      </table>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
         @include('invoices.issues.table4')
      </div>
  </div>
@endsection
