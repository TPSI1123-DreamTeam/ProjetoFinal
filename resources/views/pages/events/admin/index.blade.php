@extends('DashboardMaster.main')
@section('content')
    @component('components.events.admin.event-list', ['events' => $events, 'Category' => $Category, 'formFields' => $formFields])
    @endcomponent
@endsection