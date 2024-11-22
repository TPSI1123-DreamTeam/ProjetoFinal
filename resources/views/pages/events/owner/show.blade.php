@extends('DashboardMaster.main')
@section('content')
    @component('components.events.owner.event-show', ['event' => $event])
    @endcomponent
@endsection