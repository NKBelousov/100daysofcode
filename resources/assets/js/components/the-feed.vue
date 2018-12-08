<template>
  <div>
    <h1 class="md-headline">Всего мемов: {{ total }}</h1>
    <md-field>
      <label>Поиск</label>
      <md-input :value="request.query.search" @input="search($event)"></md-input>
    </md-field>
    <md-card v-for="item in items" :key="item.id">
      <md-card-header>
        <div class="date">{{ moment(item.created_at).format("DD/MM/YYYY") }}</div>
        {{ item.title }}
      </md-card-header>
      <md-card-content>
        {{ item.description }}
        <div class="tags">
          <button
            :key="tag.id"
            @click="applySearch(tag.name)"
            class="tag"
            v-for="tag in item.tags"
          >{{ tag.name }}</button>
        </div>
      </md-card-content>
      <md-card-actions>
        <md-button @click="setGrade(item.id, 'positive')">
          <md-icon :class="hasPositiveRating(item.id) ? 'thumb_up' : ''">thumb_up</md-icon>
          {{ getGradeCountByValue(item.grades, 'positive') }}
        </md-button>
        <md-button @click="setGrade(item.id, 'negative')">
          <md-icon :class="hasNegativeRating(item.id) ? 'thumb_down' : ''">thumb_down</md-icon>
          {{ getGradeCountByValue(item.grades, 'negative') }}
        </md-button>
        <md-button @click="favorite(item.id)">
          <md-icon :class="isFavorite(item.id)">turned_in</md-icon>
        </md-button>
      </md-card-actions>
    </md-card>
    <md-button @click="loadMore()" :disabled="hasLoadedAll">Загрузить еще</md-button>
    <md-snackbar :md-active="isFailed">Вы уже выставляли оценку этому мему</md-snackbar>
  </div>
</template>

<script>
import { cloneDeep, debounce, find, filter, groupBy, map } from "lodash";
import moment from "moment";

import FavoriteService from "./../utils/FavoriteService";
import FeedService from "./../utils/FeedService";
import GradeService from "./../utils/GradeService";
import Request from "./../utils/Request";
import UserService from "./../utils/UserService";

export default {
  data() {
    return {
      items: [],
      request: new Request(),
      total: 0,
      user: {},
      isFailed: false,
    };
  },
  computed: {
    count() {
      return this.items.length;
    },
    hasLoadedAll() {
      return this.count === this.total;
    },
    search() {
      return debounce(this.applySearch, 750);
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
    applySearch(term) {
      this.request.search(term).page(1);
      FeedService.list(this.request).then(feed => {
        this.items = feed.data;
        this.total = feed.total;
      });
    },
    moment: moment,
    getGradeCountByValue(grades, value) {
      return grades.filter(g => {
        return g.value === value;
      }).length;
    },
    findRating(meme_id, grade_value) {
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
    hasPositiveRating(meme_id) {
      const hasRating = this.findRating(meme_id, "positive");
      return typeof hasRating !== "undefined";
    },
    hasNegativeRating(meme_id) {
      const hasRating = this.findRating(meme_id, "negative");
      return typeof hasRating !== "undefined";
    },
    findAnyRating(meme_id) {
      const meme = this.items.find(meme => {
        return meme.id === meme_id;
      });
      return meme.grades.find(grade => {
        return grade.meme_id === meme_id && grade.user_id === this.user.id;
      });
    },
    isFavorite(meme_id) {
      const meme = this.items.find(meme => {
        return meme.id === meme_id;
      });
      const isFavorite = meme.favorites.find(favorite => {
        return (
          favorite.meme_id === meme_id && favorite.user_id === this.user.id
        );
      });
      if (isFavorite) {
        return "is-favorite";
      } else {
        return "is-not-favorite";
      }
    },
    favorite(meme_id) {
      const payload = {
        user_id: this.user.id,
        meme_id,
      };
      const before = cloneDeep(this.items);
      this.items = map(this.items, meme => {
        if (meme.id !== meme_id) {
          return meme;
        }
        const found = find(meme.favorites, f => {
          return f.user_id === this.user.id && f.meme_id === meme_id;
        });
        if (found !== void 0) {
          meme.favorites = filter(meme.favorites, f => {
            return f.meme_id !== meme_id || f.user_id !== this.user.id;
          });
        } else {
          meme.favorites = [...meme.favorites, payload];
        }
        return meme;
      });
      FavoriteService.save(payload).catch(() => {
        this.items = before;
      });
    },
    setGrade(meme_id, value) {
      const hasRating = this.findAnyRating(meme_id) !== void 0;
      if (hasRating) {
        this.isFailed = true;
        return;
      }
      this.isFailed = false;
      const payload = {
        user_id: this.user.id,
        meme_id,
        value,
      };
      let before = this.items.find(meme => meme.id === meme_id);
      const backup = cloneDeep(before);
      before.grades.push(payload);
      GradeService.save(payload).catch(() => {
        this.items = map(this.items, item => {
          if (item.id !== meme_id) {
            return item;
          }
          return backup;
        });
      });
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

<style lang="scss">
@import "../../sass/_variables";

.md-card {
  & + & {
    margin-top: 20px;
  }
}

.md-card-actions {
  padding: 0px;
  transition: width 0.3s ease-in-out;
  will-change: auto;
}

.md-icon.is-favorite {
  --md-theme-default-icon-on-background: #{$brand-warning};
}

.md-icon.is-not-favorite {
  --md-theme-default-icon-on-background: #{$brand-info};
}

.md-icon.thumb_up {
  --md-theme-default-icon-on-background: #{$brand-success};
}

.md-icon.thumb_down {
  --md-theme-default-icon-on-background: #{$brand-danger};
}

.date {
  font-size: 0.8em;
  font-style: italic;
  margin: 20px auto;
  opacity: 0.5;
}

.tags {
  margin: 20px 0 0;
}

.tag {
  color: $brand-info;
  display: inline-block;
  margin: 0 5px 5px 0;
  text-align: center;
  user-select: all;
  background: none;
  border: none;
  outline: none;

  &::before {
    content: "#";
  }

  &:hover {
    font-weight: bold;
  }
}
</style>
