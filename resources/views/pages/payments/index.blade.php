@extends('DashboardMaster.main')

@section('content')

@component('components.payments.payment-list', ['payments' => $payments, 'user' => $user, 'allEvents' => $allEvents])
@endcomponent

@endsection
