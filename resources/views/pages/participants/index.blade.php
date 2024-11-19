@extends('master.main')

@section('content')

@component('components.participants.participants-list', ['participants' => $participants, 'events' => $events])
@endcomponent

@endsection
