import './bootstrap';

// Toggle sidebar di layar kecil
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.querySelector('#sidebar');
    const toggler = document.querySelector('.navbar-toggler');

    toggler.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
});
