<template>
    <div class="wrapper">
        {{ message }}
    </div>
</template>

<script>
module.exports = {
  props: {
    message: {
      type: String,
      default: "Пожалуйста, подождите...",
    },
  },
};
</script>

<style scoped>
@keyframes rotate {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
.wrapper {
  background: #fff;
  border: 2px solid #bebebe;
  border-radius: 5px;
  padding: 20px;
  text-align: center;
}
.wrapper:before {
  animation: rotate 1s infinite ease;
  border-color: #eee;
  border-radius: 100%;
  border-style: solid;
  border-top-color: #3097d1;
  border-width: 1px;
  content: "";
  display: block;
  margin: 0 auto 5px;
  height: 3rem;
  transform: translate(0, 0.5rem);
  width: 3rem;
}
.wrapper:not(:first-child) {
  margin-top: 20px;
}
</style>
