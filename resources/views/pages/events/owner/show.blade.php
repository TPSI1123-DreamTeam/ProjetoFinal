@extends('DashboardMaster.main')
@section('content')
    @component('components.events.owner.event-show', ['event' => $event, 'category' => $category])
    @endcomponent
@endsection