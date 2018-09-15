<template>
    <form @submit="onSubmit($event)">
      <field label="Тег" @input="onChange" :value="name"></Field>
      <flash type="warning" v-if="status === READY">Имя тега должно быть уникальным</flash>
      <flash type="error" v-if="status === ERROR">Произошла ошибка при сохранении данных</flash>
      <flash type="success" v-if="status === SUCCESS">Данные сохранены успешно</flash>
      <button :disabled="status === LOADING" type="submit">Сохранить</button>
    </form>
</template>

<script>
const Field = require("./Field.vue");
const Flash = require("./Flash.vue");
const Preloader = require("./Preloader.vue");
const TagService = require("./../utils/TagService").default;

const ERROR = "error";
const READY = "ready";
const SUCCESS = "success";
const LOADING = "loading";

export default {
  data: function() {
    return {
      ERROR,
      LOADING,
      READY,
      SUCCESS,
      name: "",
      status: READY,
    };
  },
  methods: {
    onSubmit(event) {
      event.preventDefault();
      event.stopPropagation();
      this.status = LOADING;
      Promise.resolve(
        TagService.save({
          name: this.name,
        })
      )
        .then(() => {
          this.status = SUCCESS;
        })
        .catch(() => {
          this.status = ERROR;
        });
    },
    onChange(value) {
      this.name = value;
    },
  },
};
</script>

<style>
</style>
