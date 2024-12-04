@extends('DashboardMaster.main')
@section('content')
    @component('components.events.manager.event-to-approve', ['events' => $events,  'Category' => $Category, 'formFields' => $formFields])
    @endcomponent
@endsection