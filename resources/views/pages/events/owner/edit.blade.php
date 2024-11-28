@extends('DashboardMaster.main')
@section('content')
    @component('components.events.owner.event-edit', ['event' => $event, 'categories' => $categories, 'SupplierType' => $SupplierType])
    @endcomponent
@endsection