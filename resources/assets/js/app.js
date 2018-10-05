import Vue from "vue";
import VueMaterial from "vue-material";
import Vuex from "vuex";

import "./bootstrap";
import MemeForm from "./components/meme-form.vue";
import TagForm from "./components/tag-form.vue";
import TheFeed from "./components/the-feed.vue";
import TheProfile from "./components/the-profile.vue";
import UserList from "./components/the-user-list.vue";

Vue.use(VueMaterial);
Vue.use(Vuex);
Vue.component("meme-form", MemeForm);
Vue.component("tag-form", TagForm);
Vue.component("the-feed", TheFeed);
Vue.component("the-profile", TheProfile);
Vue.component("the-user-list", UserList);
window.Vue = require("vue");

const app = new Vue({
    el: "#app",
});
