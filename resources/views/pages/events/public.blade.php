@extends('master.main')
@section('content')
    @component('components.events.event-public-list', ['events' => $events])
    @endcomponent
@endsection