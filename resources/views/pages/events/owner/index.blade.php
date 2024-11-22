@extends('DashboardMaster.main')
@section('content')
    @component('components.events.owner.event-list', ['events' => $events])
    @endcomponent
@endsection
