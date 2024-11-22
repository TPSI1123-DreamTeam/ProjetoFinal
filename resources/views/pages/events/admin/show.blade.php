@extends('DashboardMaster.main')
@section('content')
    @component('components.events.admin.event-show', ['event' => $event])
    @endcomponent
@endsection