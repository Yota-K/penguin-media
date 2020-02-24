import Swiper from 'swiper';

window.addEventListener('DOMContentLoaded', () => {
    const mySwiper = new Swiper('.swiper-container', {
        loop: true,
        speed: 400,
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true,
        },
    });
})
