@extends('DashboardMaster.main')
@section('content')
    @component('components.events.manager.event-edit', ['event' => $event,'categories' => $categories, 'SupplierType' => $SupplierType])
    @endcomponent
@endsection