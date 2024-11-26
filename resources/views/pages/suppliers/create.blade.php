@extends('DashboardMaster.main')

@section('content')

@component('components.suppliers.supplier-form-create' , ['supplier_type' => $supplier_type]);
@endcomponent

@endsection
