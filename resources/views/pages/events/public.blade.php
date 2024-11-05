@extends('master.main')
@section('content')
    @component('components.events.public-events-show', ['events' => $events])
    @endcomponent
@endsection