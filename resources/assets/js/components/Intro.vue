<template>
    <section class="hero is-info">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ title }}
                </h1>
                <h2 class="subtitle">
                    {{ desc }}
                </h2>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: {
            title: {
                type: String,
                required: true
            },
            desc: {
                type: String,
                required: true
            }
        },
    }
</script>