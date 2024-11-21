@extends('DashboardMaster.main')

@section('content')
@component('components.dateTime.dateTime')
@endcomponent
<div class="linha-divisoria"></div>
@component('components.dashboard.dashboard-normal')
@endcomponent
@endsection
