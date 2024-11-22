@extends('DashboardMaster.main')
@section('content')
    @component('components.events.admin.event-list', ['events' => $events])
    @endcomponent
@endsection