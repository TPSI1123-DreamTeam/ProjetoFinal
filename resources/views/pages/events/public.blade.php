@extends('master.main')
@section('content')
    @component('components.searchFilter.search')
    @endcomponent
    @component('components.events.public-events-show', ['events' => $events])
    @endcomponent
@endsection