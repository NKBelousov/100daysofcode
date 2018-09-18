/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
Vue.prototype.$http = window.axios;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import BaseBlock from "./components/base-block.vue";
import TagForm from "./components/tag-form.vue";
import TheProfile from "./components/the-profile.vue";
import UserList from "./components/the-user-list.vue";

Vue.component("base-block", BaseBlock);
Vue.component("the-profile", TheProfile);
Vue.component("tag-form", TagForm);
Vue.component("the-user-list", UserList);

const app = new Vue({
  el: "#app",
});
