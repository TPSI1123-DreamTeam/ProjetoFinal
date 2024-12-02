@extends('DashboardMaster.main')
@section('content')
    @component('components.events.manager.event-supplier', ['event' => $event,'categories' => $categories, 'SupplierType' => $SupplierType, 'Suppliers' => $Suppliers, 'eventSuppliers' => $eventSuppliers])
    @endcomponent
@endsection