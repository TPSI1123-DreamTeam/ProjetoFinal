@extends('DashboardMaster.main')
@section('content')
    @component('components.events.event-adminlist', ['events' => $events])
    @endcomponent
@endsection