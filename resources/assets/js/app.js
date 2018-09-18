import Vue from "vue";

import "./bootstrap";
import BaseBlock from "./components/base-block.vue";
import TagForm from "./components/tag-form.vue";
import TheProfile from "./components/the-profile.vue";
import UserList from "./components/the-user-list.vue";

Vue.component("base-block", BaseBlock);
Vue.component("tag-form", TagForm);
Vue.component("the-profile", TheProfile);
Vue.component("the-user-list", UserList);
window.Vue = require("vue");

const app = new Vue({
  el: "#app",
});
