<template>
    <section class="users">
        <h1>Всего пользователей: {{ count }}</h1>
        <ul>
            <li v-bind:key="item.name" v-for="item in items">
                {{ item.name }}
            </li>
        </ul>
    </section>
</template>

<script>
const Preloader = require("./Preloader.vue");

const STATUS_FAIL = "FAIL";
const STATUS_LOADING = "LOADING";
const STATUS_SUCCESS = "SUCCESS";

module.exports = {
  components: {
    Preloader,
  },
  data: function() {
    return {
      items: [],
    };
  },
  computed: {
    count: function() {
      return this.items.length;
    },
  },
  mounted: function() {
    this.$http
      .get("/api/user")
      .then(response => {
        this.items = response.data;
      })
      .catch(() => {
        this.status = STATUS_FAIL;
      });
  },
};
</script>

<style scoped>
li {
  list-style: none;
}
</style>