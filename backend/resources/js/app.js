require('./bootstrap');

import Vuelidate from 'vuelidate'
import Notification from './components/Notification';
import Goal from './components/Goal';
import Task from './components/Task';
import Profile from './components/profile/Profile';
import store from './store/index';


window.Vue = require('vue');

Vue.component('Notification', require('./components/Notification.vue'));
Vue.component('Goal', require('./components/Goal.vue'));
Vue.component('Profile', require('./components/profile/Profile.vue'));
Vue.use(Vuelidate);

const app = new Vue({
    el: '#app',
    components: { Notification, Goal, Task, Profile },
    store
});
