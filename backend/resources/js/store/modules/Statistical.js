export default {
    state: {
        statistical: [],
    },
    getters: {
        getDataUser: state => state.statistical.user,
    },
    mutations: {
        setData : (state, payload) => {
            state.statistical = payload;
        }
    },
    actions: {

    },
}
