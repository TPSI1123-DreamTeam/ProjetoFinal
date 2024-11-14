@extends('DashboardMaster.main')
@section('content')
    @component('components.users.users-list', ['users' => $users])
    @endcomponent
@endsection
