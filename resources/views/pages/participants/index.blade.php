@extends('DashboardMaster.main')

@section('content')

@component('components.participants.participants-list', ['participants' => $participants, 'events' => $events, 'trueId' => $trueId])
@endcomponent

@endsection
