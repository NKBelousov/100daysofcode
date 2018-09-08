<template>
    <div class="block">
      <slot></slot>
    </div>
</template>

<style scoped>
@keyframes appear {
  0% {
    opacity: 0;
    transform: translate(0, 100%);
  }
  100% {
    opacity: 1;
    transform: translate(0, 0);
  }
}

.block {
  animation-delay: 1s;
  animation-duration: 1s;
  animation-fill-mode: forwards;
  animation-name: appear;
  background: #fff;
  opacity: 0;
  padding: 20px;
  text-align: center;
}

.block + .block {
  margin-top: 20px;
}

.block:nth-child(1) {
  animation-delay: 1s;
}

.block:nth-child(2){
  animation-delay: 2s;
}

.block:nth-child(3){
  animation-delay: 3s;
}
</style>