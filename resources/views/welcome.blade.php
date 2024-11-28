<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Prime Time Events')</title>
    @vite('resources/css/welcome-page/welcome.css')
    @vite('resources/css/welcome-page/welcomeHeader.css')
    @vite('resources/css/welcome-page/welcomeFooter.css')
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono:400,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/yesiamrocks/cssanimation.io@1.0.3/cssanimation.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <video autoplay muted loop id="myVideo">
            <source src="{{ asset ('videos/Welcome-vid.mp4') }}" type="video/mp4">
        </video>
        <div class="video-overlay"></div>
        @include('master.welcomeHeader')

        @if(session('success'))
            <div id="success-notification" class="fixed bottom-4 right-4 bg-green-500 text-white p-4 rounded-lg shadow-lg opacity-0 transform transition-all duration-300">
                {{ session('success') }}
            </div>
        @endif

        <main class="content">
            <h1 class="cssanimation sequence leFadeInTop">PRIME TIME EVENTS</h1>
            <a href="https://shorturl.at/uAYeT" style="opacity: 0.1; height: 1%;">_</a>
            <h3 class="cssanimation sequence leFadeInTop">-- Creating Memories --</h3>
            <a href="/event/public" class="botao">Descobre Mais!</a>
        </main>

        <footer class="footer">
            @include('master.welcomeFooter')
        </footer>

    </div>
    @vite('resources/js/fadeInTitle.js')
    @vite('resources/js/dropdownEvent.js')
    <script>
        function toggleMenu() {
        document.querySelector('.nav-links').classList.toggle('active');
        document.querySelector('.hamburger').classList.toggle('active');
    }

        // Função para exibir a notificação e removê-la após 3 segundos
        window.addEventListener('DOMContentLoaded', (event) => {
            const notification = document.getElementById('success-notification');
            if (notification) {
                // Avisa para a notificação aparecer suavemente
                setTimeout(() => {
                    notification.classList.remove('opacity-0');
                    notification.classList.add('opacity-100');
                }, 100);

                // Depois de 3 segundos, remove a notificação
                setTimeout(() => {
                    notification.classList.remove('opacity-100');
                    notification.classList.add('opacity-0');
                }, 3000);
            }
        });
    </script>
</body>
</html>
