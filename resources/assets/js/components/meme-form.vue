<template>
  <md-card>      
    <md-card-header>
        <h1 class="md-title">Форма создания мемов</h1>
    </md-card-header>
    <md-card-content>
      <form @submit.prevent="onSubmit($event)">
        <md-field>
          <label>Надпись сверху</label>
          <md-input v-model="data.title"></md-input>
        </md-field>
        <md-field>
          <label>Надпись снизу</label>
          <md-input v-model="data.description"></md-input>
        </md-field>
        <md-field>
          <label>Теги (через пробел)</label>
          <md-input v-model="data.tags"></md-input>
        </md-field>
        <md-snackbar :md-active="isFailed">Произошла ошибка при сохранении данных</md-snackbar>
        <md-snackbar :md-active="isSuccess">Данные сохранены успешно</md-snackbar>
        <md-button class="md-raised md-primary" :disabled="isLoading" type="submit">Сохранить</md-button>
      </form>
    </md-card-content>
  </md-card>
</template>

<script>
import TagService from "./../utils/TagService";
import MemeService from "./../utils/MemeService";

export default {
  data() {
    return {
      data: {
        title: "",
        description: "",
        tags: "",
      },
      status: "ready",
    };
  },
  computed: {
    isLoading() {
      return this.status === "loading";
    },
    isFailed() {
      return this.status === "fail";
    },
    isSuccess() {
      return this.status === "success";
    },
  },
  methods: {
    onSubmit(event) {
      this.status = "loading";
      MemeService.save({
        description: this.data.description,
        tags: this.data.tags.split(" "),
        title: this.data.title,
      })
        .then(() => {
          this.status = "success";
        })
        .catch(() => {
          this.status = "fail";
        });
    },
  },
};
</script>
