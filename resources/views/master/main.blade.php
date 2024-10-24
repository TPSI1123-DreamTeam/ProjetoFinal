<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta htto-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Project</title>
    <!-- Style Section -->
    <link href="{!! asset('resources/css/app.css') !!}" media="all" rel="stylesheet" type="text/css" />
    @yield('styles')
    <!-- Style Section -->

</head>
<body>

<!-- Header -->
@component('master.header')
@endcomponent
<!-- .Header -->



<!-- Content -->
<main>
    @yield('content')
</main>
<!-- .Content -->

@component('master.footer')
@endcomponent

<script src="{!! asset('js/app.js') !!}" type="text/javascript"></script>
@yield('scripts')

</body>
</html>
