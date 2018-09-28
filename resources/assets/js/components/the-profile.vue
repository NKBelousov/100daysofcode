<template>
  <md-card>      
    <md-card-header>
      <h1 class="md-title">Привет, {{ name }}</h1>
    </md-card-header>
    <md-card-content>
      Твой email: {{ email }}
    </md-card-content>
  </md-card>
</template>

<script>
import UserService from "./../utils/UserService";

export default {
  data() {
    return {
      email: "",
      name: "",
    };
  },
  mounted() {
    UserService.current().then(response => {
      const { email, name } = response.data;
      this.email = email;
      this.name = name;
    });
  },
};
</script>