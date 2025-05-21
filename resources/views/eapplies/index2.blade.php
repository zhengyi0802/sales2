@extends('adminlte::page')

@section('title', __('eapplies.title').'(可轉單)')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('eapplies.header').'(可轉單)' }}</h1>
@stop

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/5.0.4/css/fixedColumns.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/3.0.0/css/select.dataTables.css">
@endsection

@section('content')
<!--
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-success" href="/eapplies?flow=9">{{ __('tables.export') }}</a>
        </div>
    </div>
</div>
-->

<form id="eapply-form" action="{{ route('eapplies.exports') }}" method="POST" onSubmit="checkform()">
    @method('PUT')
    @csrf
    <table id="eapplyTable" class="stripe row-border order-column nowrap" style="width:100%">
        <thead>
            <tr>
                <th><input type="checkbox" onchange="selectAll(this)"></th>
                <th>{{ __('eapplies.id') }}</th>
                <th>{{ __('eapplies.reseller') }}</th>
                <th>{{ __('eapplies.name') }}</th>
                <th>{{ __('eapplies.phone') }}</th>
                <th>{{ __('eapplies.project') }}</th>
                <th>{{ __('eapplies.payment') }}</th>
                <th>{{ __('eapplies.created_at') }}</th>
            </tr>
        </thead>
        <tbody>
@php
    $i = 0;
@endphp
          @foreach($eapplies as $eapply)
            <tr>
                <td><input type="checkbox" id="ids" name="ids[{{ $i }}]" value="{{ $eapply->id }}" ></td>
                <td>{{ $eapply->id }}</td>
                <td>{{ mb_substr($eapply->reseller->name, 0, 4) }}</td>
                <td>{{ $eapply->name }}</td>
                <td>{{ $eapply->phone }}</td>
                <td>{{ $eapply->project->name }}</td>
                <td>{{ ($eapply->payment == 1) ? __('eapplies.payment_tt') : __('eapplies.payment_credit') }}</td>
                <td>{{ $eapply->created_at ?? '' }}</td>
            </tr>
@php
   $i++;
@endphp
          @endforeach
        </tbody>
    </table>
    <script>
         function selectAll(event) {
                idcheck = document.querySelectorAll("input[name^='ids[']");
                for(item of idcheck) {
                    if (item.type == 'checkbox') {
                        item.checked = event.checked;
                    }
                }
         }
    </script>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary" >{{ __('tables.exporting') }}</button>
    </div>
    <script>
        function checkform() {
                var hascheck = false;
                idcheck = document.querySelectorAll("input[name^='ids[']");
                for (item of idcheck) {
                    if (item.checked == true) {
                        hascheck = true;
                    }
                }
                if (hascheck == true) {
                    document.form['eapply-form'].submit();
                }
                return false;
        }
    </script>
</form>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/5.0.4/js/dataTables.fixedColumns.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/5.0.4/js/fixedColumns.dataTables.js"></script>
<script src="https://cdn.datatables.net/select/3.0.0/js/dataTables.select.js"></script>
<script src="https://cdn.datatables.net/select/3.0.0/js/select.dataTables.js"></script>
<script type="text/javascript" class="init">
new DataTable('#eapplyTable', {
    columnDefs: [
        {
            orderable: false,
            //render: DataTable.render.select(),
            targets: 0
        }
    ],
    fixedColumns: {
        start: 2
    },
    responsive: true,
    order: [[1, 'asc']],
    paging: false,
    scrollCollapse: true,
    scrollX: true,
    scrollY: 300,
    select: {
        style: 'os',
        selector: 'td:first-child'
    },
    language: {
        url: '{{ __('tables.language_url') }}'
    },
});
</script>

@endsection
