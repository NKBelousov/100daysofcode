<template>
    <form @submit="onSubmit($event)">
      <base-field label="Надпись сверху" @input="setTitle" :value="title"></base-field>
      <base-field label="Надпись снизу" @input="setDescription" :value="description"></base-field>
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
import MemeService from "./../utils/MemeService";

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
      title: "",
      description: "",
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
      MemeService.save({
        title: this.title,
        description: this.description,
      })
        .then(() => {
          this.status = STATUS_SUCCESS;
        })
        .catch(() => {
          this.status = STATUS_ERROR;
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
