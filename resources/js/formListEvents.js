const datepicker1 = document.getElementById('datepicker1');
const datepicker2 = document.getElementById('datepicker2');

// Listener para o primeiro datepicker
datepicker1.addEventListener('focusout', function () {
    if (datepicker1.value) {
        // Atualiza o valor mínimo do segundo datepicker
        datepicker2.min = datepicker1.value;
        datepicker2.minDate = datepicker1.value;

        if(datepicker2.value < datepicker1.value){
            alert('Verifique a data selecionada');
            datepicker2.value = '';
        }    
    }
});

// Listener para o segundo datepicker
datepicker2.addEventListener('focusout', function () {
    if (datepicker2.value) {
        // Atualiza o valor máximo do primeiro datepicker
        datepicker1.max     = datepicker2.value;
        datepicker1.maxDate = datepicker2.value;

        if(datepicker1.value > datepicker2.value){
            alert('Verifique a data selecionada');
            datepicker1.value = '';
        }
    }
});