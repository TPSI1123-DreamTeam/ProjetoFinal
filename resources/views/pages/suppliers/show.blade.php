@extends('DashboardMaster.main')

@section('content')

@component('components.suppliers.supplier-form-show', ['supplier' => $supplier])
@endcomponent

@endsection
