<template>
    <div class="base-block">
      <slot></slot>
    </div>
</template>

<style scoped>
@keyframes appear {
  0% {
    filter: blur(5px);
    opacity: 0;
    transform: translate(0, 100%);
  }
  100% {
    filter: blur(0px);
    opacity: 1;
    transform: translate(0, 0);
  }
}

.base-block {
  animation-delay: 1s;
  animation-duration: 1s;
  animation-fill-mode: forwards;
  animation-name: appear;
  background: #fff;
  border-radius: 5px;
  border: 1px solid #bebebe;
  box-shadow: 0px 2px 5px 0px black;
  opacity: 0;
  padding: 20px;
  text-align: center;
}

.base-block + .base-block {
  margin-top: 20px;
}

.base-block:nth-child(1) {
  animation-delay: 1s;
}

.base-block:nth-child(2) {
  animation-delay: 2s;
}

.base-block:nth-child(3) {
  animation-delay: 3s;
}
</style>