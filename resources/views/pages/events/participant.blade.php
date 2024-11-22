@extends('DashboardMaster.main')
@section('content')
    @component('components.events.event-listbyparticipant', ['events' => $events])
    @endcomponent
@endsection
