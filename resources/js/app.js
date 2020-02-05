require("./bootstrap");
window.Vue = require("vue");
import Buefy from "buefy";
import "buefy/dist/buefy.css";
import store from "./store/index";
import axios from 'axios';
import router from "./router/index";
import moment from 'moment'; 
import App from "./App.vue";
import Toasted from 'vue-toasted';
import VeeValidate from "vee-validate";
import VueLoaders from 'vue-loaders';

Vue.component('my-name', VueLoaders.component);
Vue.use(Toasted);

Vue.use(Buefy);
Vue.use(VeeValidate);
// window._ = require("lodash");
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// let token = sessionStorage.getItem('mbg-token');
// if (token) {
//     window.axios.defaults.headers.common['Authorization'] = "Bearer " + token;
// }
let token = sessionStorage.getItem('token');
if (token) {
    window.axios.defaults.headers.common['Authorization'] = "Bearer " + token;
}



//window.axios.defaults.baseURL = "http://invoice-tool-nov8.test";
window.axios.defaults.baseURL = "/api/v1";

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (sessionStorage.getItem("token") == null) {
            next({
                path: "/",

            });
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.guest)) {
        if (sessionStorage.getItem("token") == null) {
            next();
        } else {
            next();
        }
    } else {
        if (sessionStorage.getItem("token") == null) {
            next();
        } else {
            next({
                path: "/",
                params: { nextUrl: to.fullPath }
            });
        }
    }
});
const app = new Vue({
    el: '#root',
    components: {
        App
    },
    router,
    store,
    render: h => h(App)
});