
import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";
import Buefy from 'buefy' 
import 'buefy/dist/buefy.css';
Vue.use(Vuex)
Vue.use(Buefy)
const debug = process.env.NODE_ENV !== 'production'
const mutations = {
    logout(state) {
        // acquire initial state
        state.authenticated = false;
        state.user = {};
        state.authToken = null;
    },
}
// initial state
// one store for entire application
export default new Vuex.Store({
    plugins: [createPersistedState()],
    strict: debug,
    state: {
        isLoading: false,
        added: [],
        authenticated: false,
        user: {},
    },
    mutations: {
        setLoading(state, payload) {
            state.isLoading = payload;
        }
    },
    actions: {
        async setLoading(vueContext, input) {
            try {
                vueContext.commit("setLoading", input);
                console.log("INPUT", input);
            } catch (error) {
                console.log(error);
            }
        },
        login(context, user) {
            return new Promise((resolve, reject) => {
                let url = "/login";
                axios.post(url, user).then((response) => {
                    if (response.data.status === 1) {
                        let data = {
                            userinfo: response.data.result,
                            token: response.data.result.token
                        }
                        sessionStorage.removeItem('token');
                        sessionStorage.setItem("token", response.data.result.token);
                        sessionStorage.setItem("name", response.data.result.name);
                        console.log(response.data.result, "zzzggggg"); // store the token in sessionStorage
                        context.commit('updateLoggedInData', data);
                        context.commit('updateUserInfo', data);
                    }
                    resolve(response)
                }).catch((response) => {
                    sessionStorage.removeItem('token') // if the request fails, remove any possible user token if possible
                    reject(response)
                });
            });
        },
        logout(context) {
            sessionStorage.removeItem('token') // if the request fails, remove any possible user token if possible
            context.commit("logout");
        },
    },
    getters: {
    }
}) 