@extends('DashboardMaster.main')
@section('content')
    @component('components.events.owner.event-show', ['events' => $events])
    @endcomponent
@endsection