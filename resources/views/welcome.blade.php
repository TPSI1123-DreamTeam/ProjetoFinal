<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Prime Time Events')</title>
    @vite('resources/css/welcome.css')
    @vite('resources/css/welcomeHeader.css')
    @vite('resources/css/welcomeFooter.css')
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono:400,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/yesiamrocks/cssanimation.io@1.0.3/cssanimation.min.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <video autoplay muted loop id="myVideo">
            <source src="{{ asset ('videos/Welcome-vid.mp4') }}" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
        @include('master.welcomeHeader')

        <main class="content">
            <h1 class="cssanimation sequence leFadeInTop">PRIME TIME EVENTS</h1>
            <h3 class="cssanimation sequence leFadeInTop">-- Creating Memories --</h3>
            <a href="/event" class="botao">Descobre Mais!</a>
        </main>

        <footer class="footer">
            @include('master.welcomeFooter')
        </footer>
        
    </div>
    @vite('resources/js/fadeInTitle.js')
</body>
</html>