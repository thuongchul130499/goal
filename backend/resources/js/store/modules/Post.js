export default {
    state: {
        posts: [],
        loading: true,
        endPage: 0,
    },
    getters: {
        getPosts: state => {
            return state.posts;
        },
        getLoading: state => {
            return state.loading;
        }
    },
    mutations: {
        setPosts: (state, payload) => {
            if (state.posts.length === 0) state.posts = payload.data;
            else state.posts = state.posts.concat(payload.data);
            state.loading = false;
            state.endPage = payload.last_page;
        },
        addPost: (state, payload) => {
            state.posts.unshift(payload.data.post);
        },
        setLoading: state => {
            state.loading = true;
        }
    },
    actions: {
        fetchPost: async ({ commit, state }, data) => {
            if (data.page === state.endPage) return;
            window.axios.get(`/posts?user_id=${data.user_id}&page=${data.page}`)
                .then(res => {
                    commit('setPosts', res.data);
                });
        }
    },
}