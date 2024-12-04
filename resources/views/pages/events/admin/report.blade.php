@extends('DashboardMaster.main')
@section('content')
    @component('components.events.admin.event-report', ['events' => $events,  'Category' => $Category, 'formFields' => $formFields])
    @endcomponent
@endsection
