@extends('DashboardMaster.main')

@section('content')

@component('components.invitations.invitation-form-create', ['trueId' => $trueId])
@endcomponent

@endsection
