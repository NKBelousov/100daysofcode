<template>
    <section v-if="status === STATUS_SUCCESS" class="profile">
        <h1 class="title">Привет, {{ name }}</h1>
        <p class="message">
            {{ email }}
        </p>
        <field
          :value="name"
          @input="onNameChange"
          label="Name"
        >
        </field>
    </section>
    <flash type="error" v-else-if="status === STATUS_FAIL">
        Произошла ошибка при получении данных
    </flash>
    <Preloader v-else></Preloader>
</template>

<script>
import Field from "./Field.vue";
import Flash from "./Flash.vue";
import Preloader from "./Preloader.vue";
import UserService from "./../utils/UserService";

const STATUS_FAIL = "FAIL";
const STATUS_LOADING = "LOADING";
const STATUS_SUCCESS = "SUCCESS";

export default {
  components: {
    Field,
    Flash,
    Preloader,
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
