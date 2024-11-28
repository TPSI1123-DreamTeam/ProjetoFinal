<x-guest-layout>
<div class="text-description-forgot">
    {{ __('Esqueceu-se da sua palavra-passe? Não há problema!') }}
    <br>
    {{ __('Basta indicar-nos o seu endereço de correio eletrónico e enviar-lhe-emos uma ligação de redefinição da palavra-passe que lhe permitirá escolher uma nova.') }}
</div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="forgot-input-div">
            <x-input-label class="email-forgot-label" for="email" :value="__('Email')" />
            <x-text-input id="email" class="forgot-input" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="reset-button-pw">
            <button type="submit">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>
    </form>
    <div class="redirect-go-back">
        <a href="/">
                Voltar
            </a>
        </div>
</x-guest-layout>
