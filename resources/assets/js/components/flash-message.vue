<template>
    <div :class="classNames">
      <slot></slot>
    </div>
</template>

<script>
export default {
  props: {
    type: String,
    default: "warning",
  },
  computed: {
    classNames: function() {
      return [`flash`, `flash--${this.type}`].join(" ");
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

.flash {
  border-radius: 5px;
  margin: 10px auto;
  padding: 15px;
}
.flash--error {
  animation: shake 0.82s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
  background: rgba(255, 0, 0, 0.1);
  color: red;
  transform: translate3d(0, 0, 0);
}
.flash--success {
  background: rgba(0, 255, 0, 0.1);
  color: green;
}
.flash--warning {
  background: #fcf8e3;
  color: #8a6d3b;
}
</style>