require('./bootstrap');

import CKEditor from 'ckeditor4-vue';
import Vuelidate from 'vuelidate'
import VueLazyload from 'vue-lazyload'

import Notification from './components/Notification';
import Goal from './components/Goal';
import Task from './components/Task';
import Profile from './components/profile/Profile';
import Statistical from './components/home/Statistical';
import Statline from "./components/home/Statline";

import store from './store/index';

window.Vue = require('vue');

Vue.component('Notification', require('./components/Notification.vue'));
Vue.component('Goal', require('./components/Goal.vue'));
Vue.component('Profile', require('./components/profile/Profile.vue'));
Vue.component('Statistical', require('./components/home/Statistical.vue'));
Vue.component('Statline', require('./components/home/Statline.vue'));

Vue.use(Vuelidate);
Vue.use(CKEditor);
Vue.use(VueLazyload);

const app = new Vue({
    el: '#app',
    components: { Notification, Goal, Task, Profile, Statistical, Statline },
    store
});
