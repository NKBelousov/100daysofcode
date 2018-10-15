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
    </md-card-content>
  </md-card>
</template>

<script>
import UserService from "./../utils/UserService";
import Request from "./../utils/Request";

export default {
  data() {
    return {
      items: [],
      request: new Request(),
      total: 0,
    };
  },
  mounted() {
    UserService.list(this.request).then(response => {
      this.items = response.data;
      this.total = response.total;
    });
  },
};
</script>
