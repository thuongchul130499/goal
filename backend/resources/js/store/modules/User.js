export default {
    state: {
        user: {},
        users: [],
        isFollow: false,
    },
    getters: {
        user: state => {
            return state.user;
        },
        users: state => {
            return state.users;
        },
        isFollow: state => {
            return state.isFollow;
        }
    },
    mutations: {
        setUser: (state, payload) => {
            state.user = payload.user;
            state.isFollow = payload.isFollow;
            if (payload.users != undefined) {
                state.users = payload.users;
            }
        }
    },
    actions: {
        fetchUser: async (context) => {
            window.axios(location.href)
                .then( e => {
                    context.commit('setUser', e.data.data);
                    return true;
                });
        },
        saveIntro: async (context, data) => {
            return window.axios.put(location.href, data)
        }
    },
}