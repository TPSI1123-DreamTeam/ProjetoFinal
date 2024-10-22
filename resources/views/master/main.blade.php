<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Prime Time Events')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        @include('master.header')

        <main class="content">
            @yield('content')
        </main>

        <footer class="footer">
            @include('master.footer')
        </footer>
        
    </div>
    @vite('resources/js/app.js')
</body>
</html>