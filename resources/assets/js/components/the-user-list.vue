<template>
  <md-card>      
    <md-card-header>
      <h1 class="md-title">Всего пользователей: {{ count }}</h1>
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

export default {
  data() {
    return {
      items: [],
    };
  },
  computed: {
    count() {
      return this.items.length;
    },
  },
  mounted() {
    UserService.list().then(response => {
      this.items = response;
    });
  },
};
</script>

<style scoped>
li {
  list-style: none;
}
</style>