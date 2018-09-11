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
    <section v-else-if="status === STATUS_FAIL" class="profile profile--error">
        Произошла ошибка при получении данных
    </section>
    <Preloader v-else></Preloader>
</template>

<script>
const Field = require("./Field.vue");
const Preloader = require("./Preloader.vue");
const UserService = require("./../utils/UserService").default;

const STATUS_FAIL = "FAIL";
const STATUS_LOADING = "LOADING";
const STATUS_SUCCESS = "SUCCESS";

module.exports = {
  components: {
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
@keyframes shake {
  10%,
  90% {
    transform: translate3d(-1px, 0, 0);
  }

  20%,
  80% {
    transform: translate3d(2px, 0, 0);
  }

  30%,
  50%,
  70% {
    transform: translate3d(-4px, 0, 0);
  }

  40%,
  60% {
    transform: translate3d(4px, 0, 0);
  }
}

.profile {
  text-align: center;
}

.profile--error {
  animation: shake 0.82s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
  border-color: #ff0000;
  color: #ff0000;
  opacity: 1;
  transform: translate3d(0, 0, 0);
}

.title {
  font-size: 2em;
}
.message {
  font-size: 0.8em;
  opacity: 0.8;
}
</style>
