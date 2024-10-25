window.onload = function() {
    animateSequence();
};

function animateSequence() {
    var a = document.getElementsByClassName('sequence');
    var lastElement = a[a.length - 1]; // Último elemento que terá animação

    // Adicionar animação em sequência nas letras
    for (var i = 0; i < a.length; i++) {
        var $this = a[i];
        var letter = $this.innerHTML;
        letter = letter.trim();
        var str = '';
        var delay = 100;
        for (let l = 0; l < letter.length; l++) {
            if (letter[l] != ' ') {
                str += '<span style="animation-delay:' + delay + 'ms; -moz-animation-delay:' + delay + 'ms; -webkit-animation-delay:' + delay + 'ms; ">' + letter[l] + '</span>';
                delay += 150;
            } else {
                str += letter[l];
            }
        }
        $this.innerHTML = str;
    }

    // Esperar pela conclusão da última animação e então iniciar a animação do botão
    lastElement.addEventListener('animationend', function() {
        var botao = document.querySelector('.botao');
        botao.style.opacity = '1'; // Mostrar o botão com transição suave
        botao.classList.add('cssanimation', 'zoomIn'); // Adicionar a animação ao botão
    });
}
