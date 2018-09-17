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
import Profile from "./components/Profile.vue";
import TagForm from "./components/TagForm.vue";
import UserList from "./components/UserList.vue";

Vue.component("base-block", BaseBlock);
Vue.component("profile", Profile);
Vue.component("tagform", TagForm);
Vue.component("userlist", UserList);

const app = new Vue({
  el: "#app",
});
