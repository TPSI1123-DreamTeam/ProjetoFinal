document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.nav a');

    links.forEach(link => {
        link.addEventListener('click', function(e) {
            links.forEach(l => l.classList.remove('active'));

            this.classList.add('active');

            if (this.getAttribute('href').startsWith('#')) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });
});