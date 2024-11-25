const button = document.getElementById('events_pending');
const hiddenInput = document.getElementById('pending');

button.addEventListener('click', function (event) {
    event.preventDefault(); // Evita o envio imediato do formulário
    hiddenInput.value = 'pending'; // Define o valor do input hidden

    // Agora você pode enviar o formulário manualmente, se necessário:
    button.closest('form').submit();
});