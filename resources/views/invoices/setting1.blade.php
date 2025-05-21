<div class="row">
  <h2>{{ __('invoices.GetGovInvoiceWordSetting') }}</h2>
  <form name="settingForm1" method="get" action="{{ route('invoices.GetGovInvoiceWordSetting') }}">
      <input type="submit">
  </form>
@if (isset($results))
    @include('invoices.table1')
@endif
</div>

<div class="row">
  <h2>{{ __('invoices.AddInvoiceWordSetting') }}</h2>
   @if (isset($result1))
        {{ __('invoices.TrackID') }} : {{ $result1->track_id }}
   @endif
</div>

<div class="row">
  <h2>{{ __('invoices.UpdateInvoiceWordStatus') }}</h2>
   @if (isset($data))
        {{ $data }}
   @endif
</div>

<div class="row">
  <h2>{{ __('invoices.GetInvoiceWordSetting') }}</h2>
   @if (isset($invs))
        @include('invoices.table2')
   @endif
</div>

<div>
  <h2>{{ __('invoices.GetCompanyNameByTaxID') }}</h2>
  <form name="companyForm1" method="get" action="{{ route('invoices.GetCompanyNameByTaxID') }}">
      <p>{{ __('invoices.UnifiedBusinessNo') }}<input type="text" name="UnifiedBusinessNo" >
      <input type="submit"></p>
  </form>
  @if (isset($companyName))
         <p>{{ __('invoices.companyName') }} : {{ $companyName }}</div>
  @endif
</div>

