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
            <md-button @click="thumbUp(item.id)"><md-icon>thumb_up</md-icon></md-button>
            <md-button @click="thumbDown(item.id)"><md-icon>thumb_down</md-icon></md-button>
          </md-card-actions>
        </md-card>
  </div>
</template>

<script>
import FeedService from "./../utils/FeedService";
import GradeService from "./../utils/GradeService";

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
    Promise.all([FeedService.list(), GradeService.list()]).then(
      ([feed, grades]) => {
        this.items = feed.data;
        this.total = feed.total;
      }
    );
  },
  methods: {
    thumbUp(meme_id) {
      GradeService.save({
        meme_id,
        value: "positive",
      });
    },
    thumbDown(meme_id) {
      GradeService.save({
        meme_id,
        value: "negative",
      });
    },
  },
};
</script>

<style>
.md-card + .md-card {
  margin-top: 10px;
}
</style>
