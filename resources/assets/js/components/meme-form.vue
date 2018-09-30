<template>
  <md-card>      
    <md-card-header>
        <h1 class="md-title">Форма создания мемов</h1>
    </md-card-header>
    <md-card-content>
      <form @submit="onSubmit($event)">
        <md-field>
          <label>Надпись сверху</label>
          <md-input :model="title" @input="setTitle"></md-input>
        </md-field>
        <md-field>
          <label>Надпись снизу</label>
          <md-input :model="description" @input="setDescription"></md-input>
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
      title: "",
      description: "",
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
      event.preventDefault();
      event.stopPropagation();
      this.status = "loading";
      MemeService.save({
        title: this.title,
        description: this.description,
      })
        .then(() => {
          this.status = "success";
        })
        .catch(() => {
          this.status = "fail";
        });
    },
    setTitle(title) {
      this.title = title;
    },
    setDescription(description) {
      this.description = description;
    },
  },
};
</script>
