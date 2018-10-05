<template>
  <div>
      <h1 class="md-headline">Всего мемов: {{ total }}</h1>
      <h1 class="md-caption">На текущей странице: {{ count }}</h1>
        <md-card v-for="item in items" :key="item.id">
          <md-card-header>
            {{ item.title }}
          </md-card-header>
          <md-card-content>
          {{ item.description }}
          </md-card-content>
          <md-card-actions>
            <md-button><md-icon>thumb_up</md-icon></md-button>
            <md-button><md-icon>thumb_down</md-icon></md-button>
          </md-card-actions>
        </md-card>
  </div>
</template>

<script>
import FeedService from "./../utils/FeedService";

export default {
  data() {
    return {
      items: [],
      total: 0,
    };
  },
  computed: {
    count() {
      return this.items.length;
    },
  },
  mounted() {
    FeedService.list().then(response => {
      this.items = response.data;
      this.total = response.total;
    });
  },
};
</script>

<style>
.md-card + .md-card {
  margin-top: 10px;
}
</style>
