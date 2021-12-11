require('./bootstrap');

window.Vue = require('vue');

Vue.component('index', require('./components/index'));

const app = new Vue({
    el: '#app',
});
