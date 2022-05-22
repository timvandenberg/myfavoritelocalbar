require('./bootstrap');

import Vue from 'vue';
window.Vue = require('vue');

import Maps from "./components/Maps.vue";
Vue.component('Maps', Maps);

import Searchbar from "./components/Searchbar.vue";
Vue.component('Searchbar', Searchbar);

const app = new Vue({
    el: '#app',
    methods: {
        old: function(data) {
            console.log('data', data)
        }
    }
});

