const cards = document.querySelectorAll('.card');
const leftArrow = document.querySelector('.left-arrow');
const rightArrow = document.querySelector('.right-arrow');
let currentIndex = 0;

// Função para atualizar o carousel
function updateCarousel() {
    const cardWidth = 200; // largura do card
    const cardMargin = 10; // margem entre os cards

    cards.forEach((card, index) => {
        card.classList.remove('selected'); // Remove a classe 'selected' de todos os cards
        
        // Ajusta a posição X considerando apenas a largura do card e a margem
        card.style.transform = `translateX(${(index - currentIndex) * (cardWidth + 2 * cardMargin)}px)`; 
    });
    cards[currentIndex].classList.add('selected'); // Adiciona a classe 'selected' ao card central
}

// Função para ir para o próximo card
function nextCard() {
    currentIndex = (currentIndex + 1) % cards.length; // Move para o próximo card
    updateCarousel();
}

// Função para ir para o card anterior
function prevCard() {
    currentIndex = (currentIndex - 1 + cards.length) % cards.length; // Move para o card anterior
}

// Adiciona eventos de clique para as setas
rightArrow.addEventListener('click', nextCard);
leftArrow.addEventListener('click', prevCard);

// Inicializa o carousel
updateCarousel();
