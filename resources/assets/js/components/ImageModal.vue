<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-content">
            <p class="image is-4by3">
                <img :src="src" alt="">
            </p>
        </div>
        <button class="modal-close is-large" aria-label="close" @click="$emit('close')"></button>
    </div>
</template>

<script>
    export default {
        props: {
            src: {
                type: String,
                required: true
            }
        },
    }
</script>