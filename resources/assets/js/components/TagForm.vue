<template>
    <form @submit="onSubmit($event)">
      <field label="Тег" @input="onChange" :value="name"></Field>
      <div class="error" v-if="status === ERROR">Произошла ошибка при сохранении данных</div>
      <div class="error" v-if="status === SUCCESS">Данные сохранены успешно</div>
      <button :disabled="status === LOADING" type="submit">Сохранить</button>
    </form>
</template>

<script>
const Field = require("./Field.vue");
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
