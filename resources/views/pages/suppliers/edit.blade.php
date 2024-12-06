@extends('DashboardMaster.main')
@section('content')
    @component('components.suppliers.supplier-form-edit', ['supplier' => $supplier, 'supplierTypes' => $supplierTypes])
    @endcomponent
@endsection