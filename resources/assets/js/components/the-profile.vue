<template>
  <form class="md-layout" @submit.prevent="save">
    <md-dialog-alert
      :md-active.sync="dialog.visible"
      :md-content="dialog.message"
      :md-title="dialog.title"
      @md-confirm="dialog.visible = false"
    />
    <md-card class="md-layout-item">
      <md-card-header>
        <div class="md-title">Мой профиль</div>
      </md-card-header>
      <md-card-content>
        <md-field>
          <label for="name">Имя пользователя:</label>
          <md-input
            name="name"
            id="name"
            autocomplete="name"
            v-model="data.name"
            :disabled="isLoading"
          />
        </md-field>
        <md-field>
          <label for="email">E-mail:</label>
          <md-input
            name="email"
            id="email"
            autocomplete="email"
            v-model="data.email"
            :disabled="isLoading"
          />
        </md-field>
        <md-field>
          <label for="password">Пароль:</label>
          <md-input
            name="password"
            id="password"
            autocomplete="none"
            v-model="data.password"
            :disabled="isLoading"
            type="password"
          />
        </md-field>
        <md-field>
          <label for="passwordConfirmation">Повторите пароль:</label>
          <md-input
            name="passwordConfirmation"
            id="passwordConfirmation"
            autocomplete="none"
            v-model="data.passwordConfirmation"
            :disabled="isLoading"
            type="password"
          />
        </md-field>
        <md-button class="md-raised md-primary" :disabled="isLoading" type="submit">Сохранить</md-button>
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
        id: void 0,
        name: "",
        password: "",
        passwordConfirmation: "",
      },
      dialog: {
        visible: false,
        message: "",
        title: "",
      },
      isLoading: true,
    };
  },
  mounted() {
    UserService.current().then(response => {
      this.data = Object.assign(this.data, response.data);
      this.isLoading = false;
    });
  },
  methods: {
    save() {
      if (
        this.data.password === "" ||
        this.data.password !== this.data.passwordConfirmation
      ) {
        this.dialog.visible = true;
        this.dialog.message = "Введенные пароли пусты или не совпадают";
        this.dialog.title = "Упс...";
        return;
      }
      this.isLoading = true;
      UserService.save(this.data)
        .then(() => {
          this.dialog.visible = true;
          this.dialog.message = "Профиль успешно изменен";
          this.dialog.title = "Ура!";
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
