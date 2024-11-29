<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registo | PRIME TIME EVENTS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/register.css')
    <style>
        .text-red-600, .text-green-600 {
            transition: color 0.3s ease-in-out;
        }

        #confirmation-error {
            transition: opacity 0.3s ease-in-out;
            opacity: 0;
        }

        #confirmation-error.show {
            opacity: 1;
        }

        #password-requirements {
            transition: opacity 0.3s ease-in-out;
            opacity: 0;
        }

        #password-requirements.show {
            opacity: 1;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <video autoplay muted loop id="myVideo">
        <source src="{{ asset ('videos/Welcome-vid.mp4') }}" type="video/mp4">
    </video>
    <div class="video-overlay"></div>

    @if (session('notification'))
        @php
            $notification = session('notification');
        @endphp
        <div id="error-notification" class="fixed bottom-4 right-4 bg-red-500 text-white p-4 rounded-lg shadow-lg opacity-0 transform transition-all duration-300 z-50">
            {{ $notification['message'] }}
        </div>
    @endif

    <div class="register-container">
        <div class="logo-section">
            <img src="{{ asset('images/Logotipo.png') }}" alt="Logotipo" class="logo-img">
        </div>
        <div class="divider"></div> <!-- Linha de sombra entre logotipo e formulário -->
        <div class="register-box">
            <form action="{{ route('register') }}" method="POST" class="register-form">
                @csrf
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" id="name" name="name" placeholder="Digite o seu nome" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Digite o seu email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Palavra-passe</label>
                    <input type="password" id="password" name="password" placeholder="Digite a sua palavra-passe" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <ul id="password-requirements" class="mt-2 space-y-2 text-sm text-gray-600 hidden">
                        <li id="uppercase" class="text-red-600">Pelo menos uma letra maiúscula</li>
                        <li id="number" class="text-red-600">Pelo menos um número</li>
                        <li id="special" class="text-red-600">Pelo menos um caractere especial</li>
                        <li id="length" class="text-red-600">Pelo menos 8 caracteres</li>
                    </ul>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirme a Palavra-passe</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Digite novamente a palavra-passe" required>
                    <div id="confirmation-error" class="text-red-600 text-sm mt-1 hidden">As palavras-passe não coincidem</div>
                    @error('password_confirmation')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="birthdate">Data de Nascimento</label>
                    <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required>
                    @error('birthdate')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="register-button">Registar</button>
                </div>
                <div class="form-footer">
                    <p>Já tens conta? <a href="/login">Entra aqui</a></p>
                    <div class="google-login">
                        <a href="/login/google" class="google-button">Entrar com Google</a>
                    </div>
                    <a href="/" class="back-home">Voltar à página inicial</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<script>

    // Código par que vão aparecendo os requisitos da password
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const passwordConfirmationInput = document.getElementById('password_confirmation');
        const passwordRequirements = document.getElementById('password-requirements');
        const confirmationError = document.getElementById('confirmation-error');
        
        const uppercase = document.getElementById('uppercase');
        const number = document.getElementById('number');
        const special = document.getElementById('special');
        const length = document.getElementById('length');

        passwordInput.addEventListener('input', function() {
            const password = passwordInput.value;

            passwordRequirements.classList.remove('hidden');
            passwordRequirements.classList.add('show');

            if (/[A-Z]/.test(password)) {
                uppercase.classList.remove('text-red-600');
                uppercase.classList.add('text-green-600');
            } else {
                uppercase.classList.remove('text-green-600');
                uppercase.classList.add('text-red-600');
            }

            if (/\d/.test(password)) {
                number.classList.remove('text-red-600');
                number.classList.add('text-green-600');
            } else {
                number.classList.remove('text-green-600');
                number.classList.add('text-red-600');
            }

            if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
                special.classList.remove('text-red-600');
                special.classList.add('text-green-600');
            } else {
                special.classList.remove('text-green-600');
                special.classList.add('text-red-600');
            }

            if (password.length >= 8) {
                length.classList.remove('text-red-600');
                length.classList.add('text-green-600');
            } else {
                length.classList.remove('text-green-600');
                length.classList.add('text-red-600');
            }

            if (passwordConfirmationInput.value === password) {
                confirmationError.classList.remove('show');
                confirmationError.classList.add('hidden');
            } else {
                confirmationError.classList.remove('hidden');
                confirmationError.classList.add('show');
            }
        });

        //Código para verificar se a password e a confirmação são iguais

        passwordConfirmationInput.addEventListener('input', function() {
            const password = passwordInput.value;
            const confirmation = passwordConfirmationInput.value;

            if (confirmation === password) {
                confirmationError.classList.remove('show');
                confirmationError.classList.add('hidden');
            } else {
                confirmationError.classList.remove('hidden');
                confirmationError.classList.add('show');
            }
        });
    });

    // Código para mostrar a notificação de erro caso ainda exista

    window.addEventListener('DOMContentLoaded', () => {
        const errorNotification = document.getElementById('error-notification');

        if (errorNotification) {
            setTimeout(() => {
                errorNotification.classList.remove('opacity-0');
                errorNotification.classList.add('opacity-100');
            }, 100);

            setTimeout(() => {
                errorNotification.classList.remove('opacity-100');
                errorNotification.classList.add('opacity-0');
            }, 3000);
        }
    });
</script>
</html>