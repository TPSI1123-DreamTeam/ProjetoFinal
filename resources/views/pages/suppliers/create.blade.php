@extends('DashboardMaster.main')

@section('content')

@component('components.suppliers.supplier-form-create', ['supplierTypes' => $supplierTypes])
@endcomponent

@endsection
