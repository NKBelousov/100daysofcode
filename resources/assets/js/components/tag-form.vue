<template>
    <form @submit="onSubmit($event)">
      <base-field label="Тег" @input="onChange" :value="name"></base-field>
      <flash-message type="warning" v-if="status === STATUS_READY">Имя тега должно быть уникальным</flash-message>
      <flash-message type="error" v-if="status === STATUS_ERROR">Произошла ошибка при сохранении данных</flash-message>
      <flash-message type="success" v-if="status === STATUS_SUCCESS">Данные сохранены успешно</flash-message>
      <base-button :disabled="status === STATUS_LOADING" type="submit">Сохранить</base-button>
    </form>
</template>

<script>
import BaseField from "./base-field.vue";
import FlashMessage from "./flash-message.vue";
import BaseButton from "./base-button.vue";
import TagService from "./../utils/TagService";

const STATUS_ERROR = "error";
const STATUS_LOADING = "loading";
const STATUS_READY = "ready";
const STATUS_SUCCESS = "success";

export default {
  components: {
    BaseButton,
    BaseField,
    FlashMessage,
  },
  data() {
    return {
      name: "",
      status: STATUS_READY,
      STATUS_ERROR,
      STATUS_LOADING,
      STATUS_READY,
      STATUS_SUCCESS,
    };
  },
  methods: {
    onSubmit(event) {
      event.preventDefault();
      event.stopPropagation();
      this.status = STATUS_LOADING;
      TagService.save({
        name: this.name,
      })
        .then(() => {
          this.status = STATUS_SUCCESS;
        })
        .catch(() => {
          this.status = STATUS_ERROR;
        });
    },
    onChange(value) {
      this.name = value;
    },
  },
};
</script>
