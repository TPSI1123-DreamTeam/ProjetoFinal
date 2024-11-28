<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/css/forgot-pw.css'])
    </head>
    <body>
        <div class="wrapper">
            <video autoplay muted loop id="myVideo">
            <source src="{{ asset ('videos/Welcome-vid.mp4') }}" type="video/mp4">
            </video>
            <div class="video-overlay"></div>
            <div class="forgot-container">
                <div class="logo-section">
                    <img src="{{ asset ('images/Logotipo.png') }}" alt="Logotipo" class="logo-img">
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
