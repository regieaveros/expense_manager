/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Form from './Form';
window.Form = Form;

import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


//Dashboard
Vue.component('dashboard-index', require('./components/dashboard/IndexComponent.vue').default);

//Roles
Vue.component('roles-modal', require('./components/roles/Modal.vue').default);
Vue.component('roles-index', require('./components/roles/Index.vue').default);
Vue.component('roles-create', require('./components/roles/Create.vue').default);
Vue.component('roles-update-delete', require('./components/roles/UpdateDelete.vue').default);

//Users
Vue.component('users-modal', require('./components/users/Modal.vue').default);
Vue.component('users-index', require('./components/users/Index.vue').default);
Vue.component('users-create', require('./components/users/Create.vue').default);
Vue.component('users-update-delete', require('./components/users/UpdateDelete.vue').default);
Vue.component('profile-modal', require('./components/users/profile/Modal.vue').default);

//Expense Categories
Vue.component('expense-categories-modal', require('./components/expense-categories/Modal.vue').default);
Vue.component('expense-categories-index', require('./components/expense-categories/Index.vue').default);
Vue.component('expense-categories-create', require('./components/expense-categories/Create.vue').default);
Vue.component('expense-categories-update-delete', require('./components/expense-categories/UpdateDelete.vue').default);

//Expenses
Vue.component('expenses-modal', require('./components/expenses/Modal.vue').default);
Vue.component('expenses-index', require('./components/expenses/Index.vue').default);
Vue.component('expenses-create', require('./components/expenses/Create.vue').default);
Vue.component('expenses-update-delete', require('./components/expenses/UpdateDelete.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
