<template>
    <form @submit="onSubmit($event)">
      <field label="Тег" @input="onChange" :value="name"></Field>
      <flash type="warning" v-if="status === READY">Имя тега должно быть уникальным</flash>
      <flash type="error" v-if="status === ERROR">Произошла ошибка при сохранении данных</flash>
      <flash type="success" v-if="status === SUCCESS">Данные сохранены успешно</flash>
      <base-button :disabled="status === LOADING" type="submit">Сохранить</base-button>
    </form>
</template>

<script>
import Field from "./Field.vue";
import Flash from "./Flash.vue";
import BaseButton from "./base-button.vue";
import TagService from "./../utils/TagService";

const ERROR = "error";
const READY = "ready";
const SUCCESS = "success";
const LOADING = "loading";

export default {
  components: {
    BaseButton,
    Field,
    Flash,
  },
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
