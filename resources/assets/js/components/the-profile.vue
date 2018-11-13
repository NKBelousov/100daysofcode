<template>
  <form class="md-layout" @submit.prevent="save">
    <md-card class="md-layout-item">
      <md-card-header>
        <div class="md-title">Мой профиль</div>
      </md-card-header>
      <md-card-content>
        <md-field>
          <label for="name">Имя пользователя:</label>
          <md-input name="name" id="name" autocomplete="name" v-model="data.name" :disabled="isLoading" />
        </md-field>
        <md-field>
          <label for="email">E-mail:</label>
          <md-input name="email" id="email" autocomplete="email" v-model="data.email" :disabled="isLoading" />
        </md-field>
        <md-button class="md-raised md-primary" :disabled="isLoading" type="submit">
          Сохранить
        </md-button>
      </md-card-content>
    </md-card>
  </form>
</template>

<script>
import UserService from "./../utils/UserService";

export default {
  data() {
    return {
      data: {
        email: "",
        name: "",
        id: void 0,
      },
      isLoading: true,
    };
  },
  mounted() {
    UserService.current().then(response => {
      this.data = response.data;
      this.isLoading = false;
    });
  },
  methods: {
    save() {
      this.isLoading = true;
      UserService.save(this.data)
        .then(() => {
          this.isLoading = false;
        })
        .catch(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>

<style lang="scss">
.md-button {
  display: block;
  margin: 0 auto;
}
</style>
