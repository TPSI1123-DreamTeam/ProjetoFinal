@extends('DashboardMaster.main')
@section('content')
    @component('components.events.owner.event-edit', ['event' => $event])
    @endcomponent
@endsection