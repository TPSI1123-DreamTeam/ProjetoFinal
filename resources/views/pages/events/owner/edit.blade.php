@extends('DashboardMaster.main')
@section('content')
    @component('components.events.owner.event-edit', ['events' => $events])
    @endcomponent
@endsection