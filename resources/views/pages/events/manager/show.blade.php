@extends('DashboardMaster.main')
@section('content')
    @component('components.events.manager.event-show', ['event' => $event])
    @endcomponent
@endsection