@extends('DashboardMaster.main')
@section('content')
    @component('components.events.admin.event-edit', ['event' => $event])
    @endcomponent
@endsection