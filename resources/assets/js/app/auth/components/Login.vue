<template>
    <div>
        <intro-header title="Login" desc=""></intro-header>

        <section class="hero is-bold">
            <div class="hero-body">
                <div class="container">
                    <div class="columns is-centered">
                        <article class="card is-rounded">
                            <div class="card-content">
                                <h1 class="title info-title is-centered">
                                    Login
                                </h1>

                                <form-login></form-login>

                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import IntroHeader from '../../../components/Intro.vue';
    import FormLogin from './Form/FormLogin.vue';

    export default {
        created(){
            if (this.$store.getters.isLoggedIn) {
                this.$router.push({name: 'posts.index'});
            }
        },
        components: {
            'intro-header': IntroHeader,
            'form-login': FormLogin,
        },
    }
</script>
