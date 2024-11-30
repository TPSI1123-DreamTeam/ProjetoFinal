<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<main>
    <div class="front-dashboard-wrapper">
        <div class="front-dashboard-container">
            
        @if(session('success'))
            <div id="success-notification" 
            class="fixed bottom-4 right-4 bg-green-500 text-white p-4 rounded-lg shadow-lg opacity-0 transform transition-all duration-300 z-50">
        {{ session('success') }}
        </div>
        @endif


            <!-- Boas-vindas -->
            <div class="front-dashboard-card">
                <h1>Bem-vindo, {{ Auth::user()->name }}!</h1>
            </div>

            <!-- Resumo do Perfil -->
            <div class="front-dashboard-card">
                <h3>Resumo do Perfil</h3>
                <div class="front-dashboard-profile-summary">
                    <div class="row">
                        <span class="label">Nome</span>
                        <span class="value">{{ Auth::user()->name }}</span>
                    </div>
                    <div class="row">
                        <span class="label">Email</span>
                        <span class="value">{{ Auth::user()->email }}</span>
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}" class="edit-profile-btn">
                    Editar Perfil
                </a>
            </div>
        </div>
    </div>
</main>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const successNotification = document.getElementById('success-notification');

        if (successNotification) {
            setTimeout(() => {
                successNotification.classList.remove('opacity-0');
                successNotification.classList.add('opacity-100');
            }, 100);

            setTimeout(() => {
                successNotification.classList.remove('opacity-100');
                successNotification.classList.add('opacity-0');
            }, 3000);
        }
    });
</script>
