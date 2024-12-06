@extends('DashboardMaster.main')
@section('content')
    @component('components.events.owner.schedule',['event' => $event])
    @endcomponent
@endsection