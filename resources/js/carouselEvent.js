const carouselContainer = document.querySelector('.carousel-container');
const cards = Array.from(document.querySelectorAll('.card'));
const totalCards = cards.length;
let currentIndex = 0;

// Função para atualizar a exibição dos cards
function updateCards() {
    // Remove todas as classes 'selected'
    cards.forEach(card => card.classList.remove('selected'));

    // Adiciona a classe 'selected' ao card atual
    cards[currentIndex].classList.add('selected');

    // Reorganiza os cards para que o card atual fique no centro
    const halfVisible = Math.floor(totalCards / 2);
    cards.forEach((card, index) => {
        // Ajusta a ordem para que o card selecionado fique no meio
        card.style.order = (currentIndex - halfVisible + index + totalCards) % totalCards;
    });
}

// Navegar para a esquerda
document.querySelector('.left-arrow').addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + totalCards) % totalCards; // Move para o card anterior
    updateCards();
});

// Navegar para a direita
document.querySelector('.right-arrow').addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % totalCards; // Move para o próximo card
    updateCards();
});

// Inicializa a exibição
updateCards();
