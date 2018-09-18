<template>
    <section v-if="status === STATUS_SUCCESS" class="profile">
        <h1 class="title">Привет, {{ name }}</h1>
        <p class="message">
            {{ email }}
        </p>
        <base-field
          :value="name"
          @input="onNameChange"
          label="Name"
        >
        </base-field>
    </section>
    <flash-message type="error" v-else-if="status === STATUS_FAIL">
        Произошла ошибка при получении данных
    </flash-message>
    <base-preloader v-else></base-preloader>
</template>

<script>
import BaseField from "./base-field.vue";
import FlashMessage from "./flash-message.vue";
import BasePreloader from "./base-preloader.vue";
import UserService from "./../utils/UserService";

const STATUS_FAIL = "FAIL";
const STATUS_LOADING = "LOADING";
const STATUS_SUCCESS = "SUCCESS";

export default {
  components: {
    BaseField,
    FlashMessage,
    BasePreloader,
  },
  computed: {
    isLoaded: function() {
      return this.status !== LOADING;
    },
  },
  data: function() {
    return {
      email: "",
      name: "",
      STATUS_FAIL: STATUS_FAIL,
      STATUS_LOADING: STATUS_LOADING,
      STATUS_SUCCESS: STATUS_SUCCESS,
      status: STATUS_LOADING,
    };
  },
  mounted: function() {
    UserService.current()
      .then(response => {
        const { email, name } = response.data;
        this.email = email;
        this.name = name;
        this.status = STATUS_SUCCESS;
      })
      .catch(() => {
        this.status = STATUS_FAIL;
      });
  },
  methods: {
    onNameChange: function(newValue) {
      console.log(newValue);
    },
  },
};
</script>

<style scoped>
.profile {
  text-align: center;
}
.title {
  font-size: 2em;
}
.message {
  font-size: 0.8em;
  opacity: 0.8;
}
</style>
