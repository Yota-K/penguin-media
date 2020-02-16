window.addEventListener('DOMContentLoaded', () => {
    const grobalNav = document.getElementById('grobal-nav');
    const navBtn = document.getElementsByClassName('menu-trigger')[0];

    // 開くためのボタン
    navBtn.addEventListener('click', (e) => {
        grobalNav.classList.toggle('nav-active');
        e.preventDefault();
    })

    const closeBtn = document.getElementById('close-btn');

    closeBtn.addEventListener('click', (e) => {
        grobalNav.classList.toggle('nav-active');
        e.preventDefault();
    })
})
