<template>
    <div>
        <intro-header title="Register" desc=""></intro-header>

        <section class="section">
            <div class="container">
                <article class="card is-fullwidth is-rounded">
                    <div class="card-content">
                        <h1 class="title info-title is-centered">
                            Create Account
                        </h1>

                        <form-register></form-register>

                    </div>
                </article>
            </div>
        </section>

    </div>
</template>

<script>
    import IntroHeader from '../../../components/Intro.vue';
    import FormRegister from './Form/FormRegister.vue';

    export default {
        components: {
            'intro-header': IntroHeader,
            'form-register': FormRegister,
        }
    }
</script>
