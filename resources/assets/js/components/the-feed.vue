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
            <md-button @click="thumbUp(item.id)"><md-icon :class="getPositiveRating(item.id)">thumb_up</md-icon></md-button>
            <md-button @click="thumbDown(item.id)"><md-icon :class="getNegativeRating(item.id)">thumb_down</md-icon></md-button>
          </md-card-actions>
        </md-card>
  </div>
</template>

<script>
import FeedService from "./../utils/FeedService";
import GradeService from "./../utils/GradeService";
import UserService from "./../utils/UserService";

export default {
  data() {
    return {
      grades: [],
      items: [],
      total: 0,
      user: {},
    };
  },
  computed: {
    count() {
      return this.items.length;
    },
  },
  mounted() {
    Promise.all([
      UserService.current(),
      FeedService.list(),
      GradeService.list(),
    ]).then(([user, feed, grades]) => {
      this.items = feed.data;
      this.total = feed.total;
      this.grades = grades;
      this.user = user.data;
    });
  },
  methods: {
    hasRating(meme_id, grade_value) {
      return this.grades.find(grade => {
        return (
          grade.meme_id === meme_id &&
          grade.value === grade_value &&
          grade.user_id === this.user.id
        );
      });
    },
    getPositiveRating(meme_id) {
      const hasRating = this.hasRating(meme_id, "positive");
      if (hasRating) {
        return "thumb_up";
      }
      return null;
    },
    getNegativeRating(meme_id) {
      const hasRating = this.hasRating(meme_id, "negative");
      if (hasRating) {
        return "thumb_down";
      }
      return null;
    },
    thumbUp(meme_id) {
      const payload = {
        user_id: this.user.id,
        meme_id,
        value: "positive",
      };
      GradeService.save(payload);
      this.grades.push(payload);
    },
    thumbDown(meme_id) {
      const payload = {
        user_id: this.user.id,
        meme_id,
        value: "negative",
      };
      GradeService.save(payload);
      this.grades.push(payload);
    },
  },
};
</script>

<style>
.md-card + .md-card {
  margin-top: 10px;
}

.thumb_up.md-icon {
  --md-theme-default-icon-on-background: rgba(0, 255, 0, 1);
}

.thumb_down.md-icon {
  --md-theme-default-icon-on-background: rgba(255, 0, 0, 1);
}
</style>
