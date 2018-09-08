<template>
    <section v-if="status === STATUS_SUCCESS" class="section">
        <h1 class="title">Привет, {{ name }}</h1>
        <p class="message">
            {{ email }}
        </p>
    </section>
    <section v-else-if="status === STATUS_FAIL" class="section section--error">
        Произошла ошибка при получении данных
    </section>
    <Preloader v-else></Preloader>
</template>

<script>
const Preloader = require("./Preloader.vue");

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
    mounted: function(){
        this.$http.get('/api/user/current').then(response => {
            const { email, name } = response.data;
            this.email = email;
            this.name = name;
            this.status = STATUS_SUCCESS;
        }).catch(() => {
            this.status = STATUS_FAIL;
        });
    }
};
</script>

<style scoped>



@keyframes shake {
  10%, 90% {
    transform: translate3d(-1px, 0, 0);
  }
  
  20%, 80% {
    transform: translate3d(2px, 0, 0);
  }

  30%, 50%, 70% {
    transform: translate3d(-4px, 0, 0);
  }

  40%, 60% {
    transform: translate3d(4px, 0, 0);
  }
}

.section {
    animation-delay: 1s;
    animation-duration: 1s;
    animation-fill-mode: forwards;
    animation-name: appear;
    background: #fff;
    border: 2px solid #bebebe;
    border-radius: 5px;
    opacity: 0;
    padding: 20px;
    text-align: center;
}

.section--error {
    animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
    border-color: #ff0000;
    color: #ff0000;
    opacity: 1;
    transform: translate3d(0,0,0);
}

.title {
    font-size: 2em;
}
.message {
    font-size: 0.8em;
    opacity: 0.8;
}
</style>
