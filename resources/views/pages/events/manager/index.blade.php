@extends('DashboardMaster.main')
@section('content')
    @component('components.events.manager.event-list', ['events' => $events])
    @endcomponent
@endsection