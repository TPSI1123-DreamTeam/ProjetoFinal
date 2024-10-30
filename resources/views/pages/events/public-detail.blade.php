@extends('master.main')
@section('content')
    @component('components.events.event-public-detail', ['event' => $event])
    @endcomponent
@endsection