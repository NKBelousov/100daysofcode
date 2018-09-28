<template>
  <md-card>
    <md-card-header>
      <h1 class="md-title">Форма создания тегов</h1>
    </md-card-header>
    <md-card-content>
      <form @submit="onSubmit($event)">
        <base-field label="Тег" @input="onChange" :value="name"></base-field>
        <flash-message type="warning" v-if="status === 'ready'">Имя тега должно быть уникальным</flash-message>
        <flash-message type="error" v-if="status === 'fail'">Произошла ошибка при сохранении данных</flash-message>
        <flash-message type="success" v-if="status === 'success'">Данные сохранены успешно</flash-message>
        <md-button class="md-raised md-primary" :disabled="status === 'loading'" type="submit">Сохранить</md-button>
      </form>
    </md-card-content>
  </md-card>
</template>

<script>
import BaseField from "./base-field.vue";
import FlashMessage from "./flash-message.vue";
import TagService from "./../utils/TagService";

export default {
  components: {
    BaseField,
    FlashMessage,
  },
  data() {
    return {
      name: "",
      status: "ready",
    };
  },
  methods: {
    onSubmit(event) {
      event.preventDefault();
      event.stopPropagation();
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
    onChange(value) {
      this.name = value;
    },
  },
};
</script>
