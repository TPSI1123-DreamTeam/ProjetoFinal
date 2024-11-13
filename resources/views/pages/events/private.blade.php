@extends('master.main')
@section('content')
    @component('components.events.private-events-show', ['events' => $events])
    @endcomponent 
@endsection