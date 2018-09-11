<template>
    <label :for="id" class="field__container">
        <input
            :id="id"
            :value="currentValue"
            @input="update($event.target.value)"
            class="field__input"
            placeholder=" "
            type="text"
        >
        <span class="field__label">{{ label }}</span>
        <span class="field__border"></span>
    </label>
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
  margin: auto;
  position: relative;
  width: 100%;
}
.field__container:not(:first-child) {
  margin-top: 10px;
}
.field__container:not(:last-child) {
  margin-bottom: 10px;
}
.field__container .field__label {
  color: #9098a9;
  font-size: 16px;
  font-weight: 500;
  left: 0;
  position: absolute;
  top: 16px;
  transform-origin: 0 0;
  transition-duration: 0.2s;
  transition-property: transform, color;
  transition-timing-function: ease;
}
.field__container .field__border {
  background: #07f;
  bottom: 0;
  height: 2px;
  left: 0;
  position: absolute;
  transform-origin: 0 0;
  transform: scaleX(0);
  transition-duration: 0.15s;
  transition-property: transform, color;
  transition-timing-function: ease;
  width: 100%;
}
.field__container .field__input {
  background: none;
  border-bottom: 2px solid #c8ccd4;
  border-radius: 0;
  border: 0;
  color: #223254;
  font-family: inherit;
  font-size: 16px;
  font-weight: 500;
  height: 48px;
  padding: 12px 0;
  transition-duration: 0.15s;
  transition-property: transform, color;
  transition-timing-function: ease;
  width: 100%;
}
.field__container:hover .field__label {
  color: #07f;
  cursor: pointer;
}
.field__input:not(:placeholder-shown) + .field__label {
  color: #5a667f;
  transform: translateY(-1.5em) scale(0.75);
}
.field__input:focus {
  background: none;
  outline: none;
}
.field__container .field__input:focus + .field__label {
  color: #07f;
  transform: translateY(-1.5em) scale(0.75);
}
.field__container .field__input:focus + .field__label + .field__border {
  transform: scaleX(1);
}
</style>
