/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import { Form, HasError, AlertError, AlertSuccess } from 'vform'

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertSuccess.name, AlertSuccess)

// import Gate.js for user authorizations
import Gate from './Gate';
Vue.prototype.$gate = new Gate(window.user);

Vue.component('pagination', require('laravel-vue-pagination'));

import VueProgressBar from 'vue-progressbar'
const options = {
  color: '#bffaf3',
  failedColor: '#874b4b',
  thickness: '5px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  }
}

Vue.use(VueProgressBar, options)

// axios configurations
const axios = require('axios');
axios.defaults.baseURL = 'http://localhost/taxiapp';
// window.axios.defaults.headers.common = {'X-Requested-With': 'XMLHttpRequest'};
// window.axios.defaults.headers['X-CSRF-TOKEN'] = window.Laravel.csrfToken;

// ES6 Modules or TypeScript
import Swal from 'sweetalert2'
// CommonJS
window.swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

window.Toast = Toast;

// Vue JS Date Time Picker
import datetime from 'vuejs-datetimepicker';
window.datetime = datetime;

Vue.component('nav-bar', require('./components/common/Navbar.vue').default);
Vue.component('start-trip', require('./components/common/Trip.vue').default);
Vue.component('not-found', require('./components/errors/NotFound.vue').default);

var VueTruncate = require('vue-truncate-filter')
Vue.use(VueTruncate)

import vSelect from 'vue-select'
Vue.component('v-select', vSelect)
import 'vue-select/dist/vue-select.css';

import numFormat from 'vue-filter-number-format'; 
Vue.filter('numFormat', numFormat);

// moment js
Vue.use(require('vue-moment'));

//element JS
import Vue from 'vue'
import Element from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(Element)




//Register the view routes

// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
let routes = [
    { path: '/', component: require('./components/Dashboard.vue').default},
    { path: '/dashboard', component: require('./components/Dashboard.vue').default},
    { path: '/users', component: require('./components/users/Index.vue').default},
    { path: '/users/create', component: require('./components/users/Create.vue').default},
    { path: '/roles', component: require('./components/roles/Roles.vue').default},
    { path: '/trips', component: require('./components/trips/Index.vue').default},
    { path: '/schedules', component: require('./components/schedules/Index.vue').default},
    { path: '/schedules/closed', component: require('./components/schedules/Closed.vue').default},
    { path: '/schedules/:id/show', component: require('./components/schedules/Trips.vue').default},
    { path: '/roles/create', component: require('./components/roles/Create.vue').default},
    { path: '/drivers', component: require('./components/drivers/Index.vue').default},
    { path: '/driver/start/trip', component: require('./components/events/Trip.vue').default},
    { path: '/driver/continue/trip', component: require('./components/events/editTrip.vue').default},
    { path: '/drivers/create', component: require('./components/drivers/Create.vue').default},
    { path: '/drivers/show/:id', component: require('./components/drivers/Show.vue').default},
    { path: '/drivers/edit/:id', component: require('./components/drivers/Edit.vue').default},
    { path: '/drivers/:id/vehicles', component: require('./components/drivers/Vehicles.vue').default},
    { path: '/drivers/:id/trips', component: require('./components/drivers/Trips.vue').default},
    { path: '/drivers/:id/collections', component: require('./components/drivers/Collections.vue').default},
    { path: '/drivers/:id/commissions', component: require('./components/drivers/Commissions.vue').default},
    { path: '/drivers/:id/schedules', component: require('./components/drivers/Schedules.vue').default},
    { path: '/drivers/schedule/create', component: require('./components/schedules/Create.vue').default},
    { path: '/drivers/:id/schedule/create', component: require('./components/schedules/Create.vue').default},
    { path: '/bookings', component: require('./components/bookings/Index.vue').default},
    { path: '/vehicles', component: require('./components/vehicles/Index.vue').default},
    { path: '/vehicles/create', component: require('./components/vehicles/Create.vue').default},
    { path: '/vehicles/show/:id', component: require('./components/vehicles/Show.vue').default},
    { path: '/vehicles/edit/:id', component: require('./components/vehicles/Edit.vue').default},
    { path: '/settings/general', component: require('./components/settings/General.vue').default},
    { path: '/settings/structures', component: require('./components/structures/Index.vue').default},
    { path: '/settings/structures/create', component: require('./components/structures/Create.vue').default},
    { path: '/settings/structures/edit/:id', component: require('./components/structures/Edit.vue').default},
    { path: '/settings/structures/show/:id', component: require('./components/structures/Edit.vue').default},
    { path: '/organizations', component: require('./components/clients/Index.vue').default},
    { path: '/organizations/:id/edit', component: require('./components/clients/Edit.vue').default},
    { path: '/organizations/create', component: require('./components/clients/Create.vue').default},
    { path: '/invoices', component: require('./components/invoices/Index.vue').default},
    { path: '/reports', component: require('./components/reports/Index.vue').default},
    { path: '/reports/drivers', component: require('./components/reports/Drivers.vue').default},
    { path: '/reports/clients', component: require('./components/reports/clients/Index.vue').default},
    { path: '/reports/clients/:id/fm/:from/tn/:to', component: require('./components/windows/Clients.vue').default},
    
    { path: '/reports/invoices', component: require('./components/reports/invoices/Index.vue').default},
    { path: '/reports/invoice/:id', component: require('./components/windows/Invoice.vue').default},
    { path: '/reports/invoices/:id/fm/:from/tn/:to', component: require('./components/windows/List.vue').default},

    { path: '/reports/commissions', component: require('./components/reports/drivers/commSummary.vue').default},
    { path: '/reports/drivers/commissions', component: require('./components/reports/drivers/Comm.vue').default},

    { path: '/reports/drivers/trips', component: require('./components/reports/drivers/Trips.vue').default},

    { path: '/reports/worksheets', component: require('./components/reports/drivers/Schedule.vue').default},
    { path: '/reports/worksheets/:id/fm/:from/tn/:to', component: require('./components/windows/Amounts.vue').default},

    { path: '/reports/drivers/worksheet/:id', component: require('./components/windows/Schedule.vue').default},
  ]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
    base: '/taxiapp/',
    mode: 'history',
    routes // short for `routes: routes`
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    data:{
      counter: 0,
    },

    props: {
      userName: String,
    }
});
