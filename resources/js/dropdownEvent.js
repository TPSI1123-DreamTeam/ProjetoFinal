document.addEventListener("DOMContentLoaded", function() {
    const dropdownToggle = document.getElementById("event-toggle");
    const dropdownMenu = document.getElementById("dropdown-menu");

    dropdownToggle.addEventListener("click", function(event) {
        event.preventDefault(); // Impede o link de mudar de página
        dropdownMenu.style.display = (dropdownMenu.style.display === "block") ? "none" : "block"; // Alterna entre mostrar e esconder
    });

    // Fecha o dropdown se o clique for fora do menu
    window.addEventListener("click", function(event) {
        if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = "none";
        }
    });
});
