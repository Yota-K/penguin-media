// scssを読み込む
import '../scss/style.scss';

// jQueryを読み込む
import $ from 'jquery';

// windowオブジェクトに渡してグローバルでも使えるようにする
window.$ = $;
window.jQuery = $;

// Font Awesomeを読み込む
import '@fortawesome/fontawesome-free/js/fontawesome';
import '@fortawesome/fontawesome-free/js/solid';
import '@fortawesome/fontawesome-free/js/regular';
import '@fortawesome/fontawesome-free/js/brands';

// メインのjs
import './main.js';
