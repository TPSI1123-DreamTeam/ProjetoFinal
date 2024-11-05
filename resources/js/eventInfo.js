document.addEventListener('DOMContentLoaded', function () {
    const cardLinks = document.querySelectorAll('.card-link');
    let activeEventId = null; // Variável para armazenar o eventId ativo

    cardLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Evita que o link navegue

            const eventId = this.getAttribute('eventId'); // Captura o eventId do link
            if (activeEventId !== eventId) { // Verifica se o eventId mudou
                activeEventId = eventId; // Atualiza o eventId ativo
                updateEventDetails(this); // Chama a função para atualizar os detalhes do evento
            }
        });
    });

    // Função para atualizar os detalhes do evento
    function updateEventDetails(link) {
        // Obtenha os dados do evento
        const eventName = link.getAttribute('data-name');
        const eventDescription = link.getAttribute('data-description');
        const eventLocation = link.getAttribute('data-location');
        const eventStartDate = link.getAttribute('data-start-date');
        const eventAmount = link.getAttribute('data-amount');
        const eventAvailability = link.getAttribute('data-availability');

        // Atualiza a div event-details
        document.getElementById('event-title').textContent = eventName;
        document.getElementById('event-description').textContent = eventDescription;
        document.querySelector('#event-details p:nth-of-type(1)').textContent = `Localização: ${eventLocation}`;
        document.querySelector('#event-details p:nth-of-type(2)').textContent = `Data: ${eventStartDate}`;
        document.querySelector('#event-details p:nth-of-type(3)').textContent = `Preço: ${eventAmount}`;
        document.querySelector('#event-details p:nth-of-type(4)').textContent = `Disponibilidade: ${eventAvailability}`;
    }
});
