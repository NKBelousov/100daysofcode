<template>
  <md-card>
    <md-card-header>
      <h1 class="md-title">Форма создания тегов</h1>
    </md-card-header>
    <md-card-content>
      <form @submit.prevent="onSubmit($event)">
        <md-field>
          <label>Имя тега</label>
          <md-input v-model="name"/>
        </md-field>
        <md-snackbar :md-active="isReady">Имя тега должно быть уникальным</md-snackbar>
        <md-snackbar :md-active="isFailed">Произошла ошибка при сохранении данных</md-snackbar>
        <md-snackbar :md-active="isSuccess">Данные сохранены успешно</md-snackbar>
        <md-button class="md-raised md-primary" :disabled="status === 'loading'" type="submit">Сохранить</md-button>
      </form>
    </md-card-content>
  </md-card>
</template>

<script>
import TagService from "./../utils/TagService";

export default {
  data() {
    return {
      name: "",
      status: "ready",
    };
  },
  computed: {
    isSuccess: function() {
      return this.status === "success";
    },
    isFailed: function() {
      return this.status === "fail";
    },
    isReady: function() {
      return this.status === "ready";
    },
  },
  methods: {
    onSubmit() {
      this.status = "loading";
      TagService.save({
        name: this.name,
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
