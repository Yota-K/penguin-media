window.addEventListener('DOMContentLoaded', () => {
    // 開くための処理
    const grobalNav = document.getElementById('grobal-nav');
    const navBtn = document.getElementsByClassName('menu-trigger')[0];

    navBtn.addEventListener('click', (e) => {
        grobalNav.classList.toggle('nav-active');
        e.preventDefault();
    })

    // 閉じるための処理
    const closeBtns = document.querySelectorAll('.close-btn');

    closeBtns.forEach(closeBtn => {
        closeBtn.addEventListener('click', (e) => {
            grobalNav.classList.toggle('nav-active');
            e.preventDefault();
        })
    })

})
