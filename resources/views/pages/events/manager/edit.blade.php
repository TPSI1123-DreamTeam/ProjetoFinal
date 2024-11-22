@extends('DashboardMaster.main')
@section('content')
    @component('components.events.manager.event-edit', ['event' => $event])
    @endcomponent
@endsection