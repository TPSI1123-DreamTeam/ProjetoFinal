@extends('DashboardMaster.main')
@section('content')
    @component('components.events.owner.event-report', ['events' => $events,  'Category' => $Category, 'formFields' => $formFields])
    @endcomponent
@endsection
