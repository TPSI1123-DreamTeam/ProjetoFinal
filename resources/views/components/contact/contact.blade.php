<section class="contact">
    <div class="contact-content">
        <h2>Contacta-nos!</h2>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
            Quibusdam eaque eligendi debitis earum. Alias hic assumenda, odio perspiciatis fugiat placeat mollitia, ut, 
            obcaecati labore nulla et doloribus explicabo consequuntur amet?</p>
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
                <h2>Entre em contacto connosco!</h2>
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