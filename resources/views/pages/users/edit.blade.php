@extends('DashboardMaster.main')
@section('content')
    @component('components.users.user-form-edit', ['user' => $user])
    @endcomponent
@endsection