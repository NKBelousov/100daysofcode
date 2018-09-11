<template>
    <div class="field__container">
        <label class="field__label" :for="id">{{ label }}</label>
        <input
            :id="id"
            class="field__input"
            :value="currentValue"
            @input="update($event.target.value)"
        >
    </div>
</template>

<script>
import { uniqueId } from "lodash";

export default {
  props: {
    id: {
      type: String,
      default: function() {
        return uniqueId("field");
      },
    },
    label: {
      type: String,
      default: "Label",
    },
    value: {
      type: String,
      default: "",
    },
  },
  data() {
    return {
      currentValue: this.value,
    };
  },
  methods: {
    update(value) {
      this.currentValue = value;
      this.$emit("input", value);
    },
  },
};
</script>

<style scoped>
.field__container {
  color: #8eb4cb;
}

.field__label {
  cursor: pointer;
  margin-bottom: 10px;
}

.field__input {
  padding: 5px;
  border: 1px solid #bebebe;
}
</style>
