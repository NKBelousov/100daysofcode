<template>
    <section>
        <h1>Привет, {{ name }}</h1>
        <p>
            {{ email }}
        </p>
    </section>
</template>

<script>
    module.exports = {
        props: ['email', 'name'],
    };
</script>

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

    section {
        animation-delay: 1s;
        animation-duration: 1s;
        animation-fill-mode: forwards;
        animation-name: appear;
        background: #fff;
        border: 2px solid #bebebe;
        border-radius: 5px;
        opacity: 0;
        padding: 20px;
        text-align: center;
    }
    h1 {
        font-size: 2em;
    }
    p {
        font-size: 0.8em;
        opacity: 0.8;
    }
</style>
