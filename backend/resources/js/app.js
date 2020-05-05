require('./bootstrap');

import Vuelidate from 'vuelidate'
import Notification from './components/Notification';
import Goal from './components/Goal';

window.Vue = require('vue');

Vue.component('Notification', require('./components/Notification.vue'));
Vue.component('Goal', require('./components/Goal.vue'));
Vue.use(Vuelidate);

const app = new Vue({
    el: '#app',
    components: { Notification, Goal }
});
