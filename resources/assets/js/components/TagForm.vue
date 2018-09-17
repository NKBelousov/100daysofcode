<template>
    <form @submit="onSubmit($event)">
      <base-field label="Тег" @input="onChange" :value="name"></base-field>
      <flash-message type="warning" v-if="status === READY">Имя тега должно быть уникальным</flash-message>
      <flash-message type="error" v-if="status === ERROR">Произошла ошибка при сохранении данных</flash-message>
      <flash-message type="success" v-if="status === SUCCESS">Данные сохранены успешно</flash-message>
      <base-button :disabled="status === LOADING" type="submit">Сохранить</base-button>
    </form>
</template>

<script>
import BaseField from "./base-field.vue";
import FlashMessage from "./flash-message.vue";
import BaseButton from "./base-button.vue";
import TagService from "./../utils/TagService";

const ERROR = "error";
const READY = "ready";
const SUCCESS = "success";
const LOADING = "loading";

export default {
  components: {
    BaseButton,
    BaseField,
    FlashMessage,
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
