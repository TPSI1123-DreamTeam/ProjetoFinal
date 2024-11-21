@extends('DashboardMaster.main')

@section('content')

@component('components.dateTime.dateTime')
@endcomponent
@component('components.dashboard.dashboard-owner')
@endcomponent

@endsection
