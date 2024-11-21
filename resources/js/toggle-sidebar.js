document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.querySelector('.sidebar');
    const body = document.body;

    menuToggle.addEventListener('change', function () {
        sidebar.classList.toggle('hidden');

        if (!sidebar.classList.contains('hidden')) {
            body.classList.add('menu-open');
        } else {
            body.classList.remove('menu-open');
        }
    });
});