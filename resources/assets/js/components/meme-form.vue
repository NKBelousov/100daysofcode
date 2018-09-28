<template>
  <md-card>      
    <md-card-header>
        <h1 class="md-title">Форма создания мемов</h1>
    </md-card-header>
    <md-card-content>
      <form @submit="onSubmit($event)">
        <base-field label="Надпись сверху" @input="setTitle" :value="title"></base-field>
        <base-field label="Надпись снизу" @input="setDescription" :value="description"></base-field>
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
import MemeService from "./../utils/MemeService";

export default {
  components: {
    BaseField,
    FlashMessage,
  },
  data() {
    return {
      title: "",
      description: "",
      status: "ready",
    };
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
