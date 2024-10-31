document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.nav a');

    links.forEach(link => {
        link.addEventListener('click', function(e) {
            // Remove a classe 'active' de todos os links
            links.forEach(l => l.classList.remove('active'));

            // Adiciona a classe 'active' ao link clicado
            this.classList.add('active');

            // Se houver um link de âncora, faz scroll suave
            if (this.getAttribute('href').startsWith('#')) {
                e.preventDefault(); // Impede o comportamento padrão do link
                const targetId = this.getAttribute('href'); // Obtém o ID da seção
                const targetElement = document.querySelector(targetId); // Seleciona o elemento

                if (targetElement) {
                    // Anima a rolagem suave
                    targetElement.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });
});