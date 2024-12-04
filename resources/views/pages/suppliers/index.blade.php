@extends('DashboardMaster.main')
@section('content')
    @component('components.suppliers.suppliers-list', ['suppliers' => $suppliers, 'supplierTypes' => $supplierTypes])
    @endcomponent
@endsection
