<template>
    <div :class="getClassNames()">
      <slot></slot>
    </div>
</template>

<script>
export default {
  props: {
    type: String,
  },
  methods: {
    getClassNames() {
      return [`flash`, `flash--${this.type}`].join(" ");
    },
  },
};
</script>


<style scoped>
.flash {
  border-radius: 5px;
  margin: 10px auto;
  padding: 15px;
}
.flash--error {
  background: rgba(255, 0, 0, 0.1);
  color: red;
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