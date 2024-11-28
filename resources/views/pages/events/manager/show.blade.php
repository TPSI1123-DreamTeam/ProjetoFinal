@extends('DashboardMaster.main')
@section('content')
    @component('components.events.manager.event-show', ['event' => $event, 'category' => $category, 'suppliers' => $suppliers, 'SupplierType' => $SupplierType])
    @endcomponent
@endsection