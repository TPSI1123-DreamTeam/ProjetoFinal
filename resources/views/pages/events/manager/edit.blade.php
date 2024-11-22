@extends('DashboardMaster.main')
@section('content')
    @component('components.events.manager.event-edit', ['events' => $events])
    @endcomponent
@endsection