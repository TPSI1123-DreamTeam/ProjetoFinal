@extends('DashboardMaster.main')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<div class="profile-header-wrapper">
    <div class="title-hidder-div">
        <h1>Edite o seu Perfil!</h1>
    </div>
</div>

    <div class="linha-divisoria"></div>
    
    <div class="py-12">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-4 lg:px-6 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-2xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>
        
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-2xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>
        
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-2xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>

@endsection

