<main>
    <div class="front-dashboard-wrapper">
        <div class="front-dashboard-container">
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
