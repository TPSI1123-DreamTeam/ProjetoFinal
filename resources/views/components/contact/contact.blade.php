<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    @if(session('success'))
    <div id="success-notification" class="fixed bottom-4 right-4 bg-green-500 text-white p-4 rounded-lg shadow-lg opacity-0 transform transition-all duration-300 z-50">
        {{ session('success') }}
    </div>
    @endif

<section class="contact">
    <div class="contact-content">
        <h2>Contacta-nos!</h2>
        <p>Tens dúvidas ou precisas de assistência para organizar o teu próximo evento? <br>
        A nossa equipa está pronta para ajudar! <br> Entra em contacto connosco para obter mais informações sobre os nossos serviços, 
        esclarecer questões ou receber suporte personalizado.</p>
    </div>
    <div class="contact-container">

        <div class="contactInfo">
            <div class="box">
                <div class="icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="text">
                    <h3>Morada</h3>
                    <p>Quinta da Marqueza - Palmela, <br>Parque Industrial da Volkswagen Autoeuropa,<br> 2950-557 Q.ta do Anjo</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="text">
                    <h3>Telemóvel</h3>
                    <p>+351 915284723</p>
                </div>
                <div class="icon">
                    <i class="fa-regular fa-envelope"></i>
                </div>
                <div class="text">
                    <h3>Email</h3>
                    <p>gilberto.costa.t0127537@edu.atec.pt</p>
                </div>
            </div>
        </div>
        <div class="contactForm">
            <form action="{{ url('/contact') }}" method="POST">
                @csrf
                <h2>Entra em contacto connosco!</h2>
                <br>
                <div class="inputBox">
                    <input type="text" name="name" id="name" required>
                    <span>Nome Completo</span>
                </div>
                <div class="inputBox">
                    <input type="email" name="email" id="email" required>
                    <span>Email</span>
                </div>
                <div class="inputBox">
                    <textarea name="message" id="message" cols="30" rows="10" required></textarea>
                    <span>Escreve a tua mensagem...</span>
                </div>
                <div class="inputBox">
                    <input type="submit" name="" value="Submeter">
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const successNotification = document.getElementById('success-notification');
        const errorNotification = document.getElementById('error-notification');
        const noResultsNotification = document.getElementById('no-results-notification');
        
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
