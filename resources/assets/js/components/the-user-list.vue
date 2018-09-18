<template>
    <section class="users">
        <h1>Всего пользователей: {{ count }}</h1>
        <ul v-if="status === STATUS_SUCCESS">
            <li v-for="item in items" :key="item.name">
                {{ item.name }}
            </li>
        </ul>
        <flash-message type="error" v-else-if="status === STATUS_FAIL">
          Произошла ошибка при получении данных
        </flash-message>
    </section>
</template>

<script>
import FlashMessage from "./flash-message";
import UserService from "./../utils/UserService";

const STATUS_FAIL = "FAIL";
const STATUS_LOADING = "LOADING";
const STATUS_SUCCESS = "SUCCESS";

export default {
  components: {
    FlashMessage,
  },
  data() {
    return {
      items: [],
      status: STATUS_LOADING,
      STATUS_FAIL,
      STATUS_SUCCESS,
      STATUS_LOADING,
    };
  },
  computed: {
    count() {
      return this.items.length;
    },
  },
  mounted() {
    UserService.list()
      .then(response => {
        this.items = response;
        this.status = STATUS_SUCCESS;
      })
      .catch(() => {
        this.status = STATUS_FAIL;
      });
  },
};
</script>

<style scoped>
li {
  list-style: none;
}
</style>