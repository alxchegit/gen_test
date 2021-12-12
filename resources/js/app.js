require('./bootstrap');

import Vue from "vue";
import store from "./store";

Vue.component('front', require('./components/Front.vue').default);

const app = new Vue({
    el: '#app',
    store: store,
});
