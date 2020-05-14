import Vue from 'vue';
import Vuex from 'vuex';
import User from './modules/User';
import Post from './modules/Post';
Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        User,
        Post
    }
})