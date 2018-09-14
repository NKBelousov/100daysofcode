<template>
    <form @submit="onSubmit($event)">
      <field label="Тег" @input="onChange" :value="name"></Field>
      <button type="submit">Сохранить</button>
    </form>
</template>

<script>
const Field = require("./Field.vue");
const TagService = require("./../utils/TagService").default;

export default {
  data: function() {
    return {
      name: "",
    };
  },
  methods: {
    onSubmit(event) {
      event.preventDefault();
      event.stopPropagation();
      TagService.save({
        name: this.name,
      });
    },
    onChange(value) {
      this.name = value;
    },
  },
};
</script>

<style>
</style>
