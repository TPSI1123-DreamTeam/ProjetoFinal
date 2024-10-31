@extends('master.main')
@section('content')
    @component('components.events.event-list', ['events' => $events])
    @endcomponent
@endsection
