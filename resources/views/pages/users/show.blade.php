@extends('DashboardMaster.main')

@section('content')

@component('components.users.user-form-show', ['user' => $user])
@endcomponent

@endsection
