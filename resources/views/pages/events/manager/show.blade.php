@extends('DashboardMaster.main')
@section('content')
    @component('components.events.manager.event-show', ['events' => $events])
    @endcomponent
@endsection