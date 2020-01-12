window.addEventListener('DOMContentLoaded', () => {
    const grobalNav = document.getElementById('grobal-nav');
    const navBtn = document.getElementsByClassName('menu-trigger')[0];

    navBtn.addEventListener('click', (e) => {
        grobalNav.classList.toggle('nav-active');
        navBtn.classList.toggle('btn-active');
        e.preventDefault();
    })
})
