@extends('DashboardMaster.main')
@section('content')
    @component('components.participants.participant-event-list', ['events' => $events, 'allEvents' => $allEvents])
    @endcomponent
@endsection
