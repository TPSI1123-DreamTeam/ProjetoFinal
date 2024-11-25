<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Prime Time Events')</title>
    @vite('resources/css/client-side/welcome.css')
    @vite('resources/css/client-side/header.css')
    @vite('resources/css/client-side/footer.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono:400,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/yesiamrocks/cssanimation.io@1.0.3/cssanimation.min.css" rel="stylesheet">
</head>
<body>
        @include('master.header')

        <h1>Entre em contacto connosco!</h1>

       <form method="POST" action="{{ url('/contact') }}">
            @csrf {{-- Cross-Site Request Forgery protection --}}
            <label for="name">O seu nome:</label><br>
            <input type="text" id="name" name="name" required><br>

            <label for="email">O seu Email:</label><br>
            <input type="email" id="email" name="email" required><br>

            <label for="message">Mensagem:</label><br>
            <textarea id="message" name="message" required></textarea><br>

            <input type="submit" value="Submeter">
        </form>








        <footer class="footer">
            @include('master.footer')
        </footer>
    </div>
    @vite('resources/js/app.js')
</body>
</html>
