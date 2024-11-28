document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.querySelector('.sidebar');

    menuToggle.addEventListener('change', () => {
        if (menuToggle.checked) {
            sidebar.classList.add('open');
        } else {
            sidebar.classList.remove('open');
        }
    });
});