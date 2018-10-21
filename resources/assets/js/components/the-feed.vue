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
            <md-button @click="thumbUp(item.id)" :disabled="hasAnyRating(item.id)">
              <md-icon :class="getPositiveRating(item.id)">thumb_up</md-icon>
            </md-button>
            <md-button @click="thumbDown(item.id)" :disabled="hasAnyRating(item.id)">
              <md-icon :class="getNegativeRating(item.id)">thumb_down</md-icon>
            </md-button>
          </md-card-actions>
        </md-card>
        <md-button @click="loadMore()" :disabled="hasLoadedAll()">Загрузить еще</md-button>
  </div>
</template>

<script>
import FeedService from "./../utils/FeedService";
import GradeService from "./../utils/GradeService";
import Request from "./../utils/Request";
import UserService from "./../utils/UserService";

export default {
  data() {
    return {
      grades: [],
      items: [],
      request: new Request(),
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
      FeedService.list(this.request),
      GradeService.list(),
    ]).then(([user, feed, grades]) => {
      this.items = feed.data;
      this.total = feed.total;
      this.grades = grades.data;
      this.user = user.data;
    });
  },
  methods: {
    hasLoadedAll() {
      return this.count === this.total;
    },
    removeGrade(meme_id) {
      this.grades = this.grades.filter(g => {
        return meme_id !== g.meme_id;
      });
    },
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
    hasAnyRating(meme_id) {
      const rating =
        this.hasRating(meme_id, "positive") ||
        this.hasRating(meme_id, "negative") ||
        false;
    },
    thumbUp(meme_id) {
      const payload = {
        user_id: this.user.id,
        meme_id,
        value: "positive",
      };
      this.grades.push(payload);
      GradeService.save(payload).catch(this.removeGrade.bind(this, meme_id));
    },
    thumbDown(meme_id) {
      const payload = {
        user_id: this.user.id,
        meme_id,
        value: "negative",
      };
      this.grades.push(payload);
      GradeService.save(payload).catch(this.removeGrade.bind(this, meme_id));
    },
    loadMore() {
      this.request.nextPage();
      FeedService.list(this.request).then(feed => {
        this.items = [...this.items, ...feed.data];
        this.total = feed.total;
      });
    },
  },
};
</script>

<style>
.md-card + .md-card {
  margin-top: 10px;
}

.md-button.md-theme-default[disabled]
  .md-icon-font:not(.thumb_up):not(.thumb_down) {
  opacity: 0.25;
  filter: blur(5px);
}
.md-button.md-theme-default[disabled] .md-icon-font.thumb_up {
  --color: rgba(0, 255, 0, 1);
  --md-theme-default-icon-disabled-on-background: var(--color);
}
.md-button.md-theme-default[disabled] .md-icon-font.thumb_down {
  --color: rgba(255, 0, 0, 1);
  --md-theme-default-icon-disabled-on-background: var(--color);
}

.thumb_up.md-icon {
  --md-theme-default-icon-on-background: rgba(0, 255, 0, 1);
}

.thumb_down.md-icon {
  --md-theme-default-icon-on-background: rgba(255, 0, 0, 1);
}
</style>
