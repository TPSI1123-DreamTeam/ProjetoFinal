document.addEventListener("DOMContentLoaded", () => {
    const userToggle = document.getElementById("user-toggle");
    const dropdownMenu = document.querySelector(".dropdown-menu");

    userToggle.addEventListener("click", () => {
        const isVisible = dropdownMenu.style.display === "block";
        dropdownMenu.style.display = isVisible ? "none" : "block";
    });

    // Fecha o menu ao clicar fora
    document.addEventListener("click", (event) => {
        if (!userToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = "none";
        }
    });
});