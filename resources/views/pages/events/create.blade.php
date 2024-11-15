@extends('master.main')
@section('content')
    @component('components.events.event-create', ['category' => $category])
    @endcomponent
@endsection