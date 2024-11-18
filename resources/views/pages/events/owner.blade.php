@extends('master.main')
@section('content')
    @component('components.events.event-listbyowner', ['events' => $events])
    @endcomponent
@endsection
