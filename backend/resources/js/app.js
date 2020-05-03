require('./bootstrap');
import Notification from './components/Notification';
window.Vue = require('vue');
Vue.component('Notification', require('./components/Notification.vue'));

const app = new Vue({
    el: '#app',
    components: { Notification }
});
