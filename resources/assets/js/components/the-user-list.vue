<template>
  <md-card>      
    <md-card-header>
      <h1 class="md-title">Всего пользователей: {{ total }}</h1>
    </md-card-header>
    <md-card-content>
      <ul>
        <li v-for="item in items" :key="item.name">
          {{ item.name }}
        </li>
      </ul>
      <md-button v-if="items.length < total" @click="loadMore">
        Загрузить еще
      </md-button>
    </md-card-content>
  </md-card>
</template>

<script>
import UserService from "./../utils/UserService";
import Request from "./../utils/Request";

const LOADING = "loading";
const READY = "ready";

export default {
  data() {
    return {
      items: [],
      request: new Request(),
      status: LOADING,
      total: 0,
    };
  },
  mounted() {
    UserService.list(this.request).then(response => {
      this.items = response.data;
      this.total = response.total;
      this.status = READY;
    });
  },
  methods: {
    loadMore: function() {
      if (this.status === LOADING) {
        return;
      }
      this.request.nextPage();
      UserService.list(this.request).then(response => {
        this.items = [...this.items, ...response.data];
      });
    },
  },
};
</script>

<style>
.md-button {
  display: block;
  margin: 0px auto;
}
</style>