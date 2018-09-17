<template>
    <button type="button" role="button">
        <slot></slot>
    </button>
</template>

<style>
button {
  background: #3097d1;
  color: #fff;
  padding: 5px;
  margin: 0 auto;
  border: none;
}
button:disabled {
  background: grey;
  color: #fff;
  cursor: not-allowed;
}
button:focus {
  font-weight: bold;
}
button:hover {
  background: #fff;
  color: #3097d1;
}
</style>
