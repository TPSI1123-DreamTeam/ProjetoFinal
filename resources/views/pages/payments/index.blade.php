@extends('DashboardMaster.main')

@section('content')

@component('components.payments.payment-list', ['payments' => $payments, 'user' => $user])
@endcomponent

@endsection
