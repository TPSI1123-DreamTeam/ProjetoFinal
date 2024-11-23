const startDate = document.getElementById('start_date');
const endDate = document.getElementById('end_date');

// Atualizar o "min" do End Date com base no Start Date
startDate.addEventListener('change', function () {
    endDate.min = startDate.value; // Define o mínimo permitido para o end_date
    if (endDate.value && endDate.value < startDate.value) {
        endDate.value = ''; // Reseta o end_date se for inválido
    }
});

// Atualizar o "min" do Start Date com base no End Date
endDate.addEventListener('change', function () {
    if (endDate.value) {
        startDate.max = endDate.value; // Define o máximo permitido para o start_date
    }
    if (startDate.value && startDate.value > endDate.value) {
        startDate.value = ''; // Reseta o start_date se for inválido
    }
});

// Definir o mínimo inicial para Start Date
//startDate.min = new Date().toISOString().split('T')[0];

// Validar hora do End Time em relação ao Start Time
const startTime = document.getElementById('start_time');
const endTime = document.getElementById('end_time');
startTime.addEventListener('change', function () {
    endTime.min = startTime.value;
});