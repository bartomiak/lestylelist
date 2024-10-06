import "../css/style.scss";
import { createRoot } from "@wordpress/element";


// Our modules / classes
import MobileMenu from "./modules/MobileMenu";
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
// import * as Vue from 'vue'

// Vue.config.devtools = false
// import { createApp } from 'vue/dist/vue.esm-bundler';
import ReactSearch from './components/ReactSearch.jsx'



window.addEventListener("DOMContentLoaded", (event) => {
    let mobileMenu = new MobileMenu();
    // let searchSelector = document.querySelector('#vue')

    // if (searchSelector) {
    //     const app = Vue.createApp(Search)
    //     app.mount('#vue')
    // }

    const container = document.getElementById('search');
    const root = createRoot(container);
    root.render(<ReactSearch rootUrl={rootVariables.root_url} />);

    new Swiper('.swiper-container', {
        modules: [Navigation, Pagination, Autoplay],
        speed: 2000,
        autoplay: {
            delay: 5000,
        },
        loop: true,
    });

    new Swiper('.swiper-links-container', {
        modules: [Navigation, Pagination, Autoplay],
        speed: 2000,
        autoplay: {
            delay: 3000,
        },
        navigation: {
            nextEl: '.swiper-button-next-links',
            prevEl: '.swiper-button-prev-links',
        },
        slidesPerView: 1,
        loop: false,
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 3,
            },
            1280: {
                slidesPerView: 3,
            },
        },
    });

    new Swiper('.swiper-look-container', {
        modules: [Navigation, Pagination, Autoplay],
        speed: 2000,
        autoplay: {
            delay: 3000,
        },
        slidesPerView: 1,
        loop: false,
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 4,
            },
            1024: {
                slidesPerView: 4,
            },
            1280: {
                slidesPerView: 4,
            },
        },
    });
});
