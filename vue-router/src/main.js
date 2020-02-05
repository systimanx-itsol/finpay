// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.


import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
import axios from 'axios'
import moment from 'moment'
// import "./vee-validate";
import VeeValidateLaravel from 'vee-validate-laravel';
import veevalidate from 'vee-validate';
import Notifications from 'vue-notification';

Vue.config.productionTip = false

Vue.use(Toasted, {

  duration: 1000

})

Vue.use(Notifications)
Vue.use(Buefy)
Vue.use(VeeValidate)
Vue.use(VeeValidateLaravel)

Vue.config.productionTip = false


window.axios = require('axios');
window.toast = require('toast');
window.baseurl = '/api/v1';
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.baseURL = baseurl;
let token = sessionStorage.getItem('token');
if (token) {
  window.axios.defaults.headers.common['Authorization'] = "Bearer " + token;
}


new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app');

