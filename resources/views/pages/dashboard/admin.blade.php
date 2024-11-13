@extends('master.main')
@section('content')
@component('components.dashboard.dashboard-admin', ['users' => $users])
@endcomponent
@endsection
