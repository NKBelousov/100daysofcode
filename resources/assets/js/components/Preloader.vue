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
    .wrapper {
        background: #fff;
        border: 2px solid #bebebe;
        border-radius: 5px;
        padding: 20px;
        text-align: center;
    }
    .wrapper:not(:first-child){
        margin-top: 20px;
    }
</style>
