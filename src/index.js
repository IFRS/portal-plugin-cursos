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

Vue.prototype.$http = axios.create({
  baseURL: wp.api,
  timeout: 5000,
});

Vue.prototype.$wp = wp;
delete window.wp;

Vue.filter('plural', (count, singular, plural) => {
  if (count <= 1) {
    return singular;
  } else {
    return plural;
  }
});

new Vue({
  router,
  render: h => h(App),
}).$mount('#ifrs-cursos');
