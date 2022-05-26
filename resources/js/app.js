require('./bootstrap');

import Vue from 'vue';
window.Vue = require('vue');

import Maps from "./components/Maps.vue";
Vue.component('Maps', Maps);

import SearchbarCity from "./components/SearchbarCity.vue";
Vue.component('searchbar-city', SearchbarCity);

import SearchbarPlace from "./components/SearchbarPlace.vue";
Vue.component('searchbar-place', SearchbarPlace);

import SearchbarBar from "./components/SearchbarBar.vue";
Vue.component('searchbar-bar', SearchbarBar);

const app = new Vue({
    el: '#app',
    methods: {
        old: function(data) {
            console.log('data', data)
        }
    }
});

