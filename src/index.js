import axios from 'axios';
import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App';

Vue.use(VueRouter);

import Cursos from './Cursos';
import Curso from './Curso';

const routes = [
  {
    path: '/',
    component: Cursos,
  },
  {
    path: '/:slug',
    component: Curso,
    props: true,
  }
];

const router = new VueRouter({
  routes,
});

Vue.prototype.$axios = axios.create({
  baseURL: wp.api,
  timeout: 5000,
});

new Vue({
  router,
  render: h => h(App),
}).$mount('#ifrs-cursos');
