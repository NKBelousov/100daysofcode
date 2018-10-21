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
              {{ getGradeCountByValue(item.grades, 'positive') }}
            </md-button>
            <md-button @click="thumbDown(item.id)" :disabled="hasAnyRating(item.id)">
              <md-icon :class="getNegativeRating(item.id)">thumb_down</md-icon>
              {{ getGradeCountByValue(item.grades, 'negative') }}
            </md-button>
          </md-card-actions>
        </md-card>
        <md-button @click="loadMore()" :disabled="hasLoadedAll()">Загрузить еще</md-button>
  </div>
</template>

<script>
import GradeService from "./../utils/GradeService";
import FeedService from "./../utils/FeedService";
import Request from "./../utils/Request";
import UserService from "./../utils/UserService";

export default {
  data() {
    return {
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
    Promise.all([UserService.current(), FeedService.list(this.request)]).then(
      ([user, feed]) => {
        this.items = feed.data;
        this.total = feed.total;
        this.user = user.data;
      }
    );
  },
  methods: {
    getGradeCountByValue(grades, value) {
      return grades.filter(g => {
        return g.value === value;
      }).length;
    },
    hasLoadedAll() {
      return this.count === this.total;
    },
    hasRating(meme_id, grade_value) {
      const meme = this.items.find(meme => {
        return meme.id === meme_id;
      });
      return meme.grades.find(grade => {
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
      GradeService.save(payload);
    },
    thumbDown(meme_id) {
      const payload = {
        user_id: this.user.id,
        meme_id,
        value: "negative",
      };
      GradeService.save(payload);
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
