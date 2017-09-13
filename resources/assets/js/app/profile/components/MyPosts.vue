<template>
    <div>
        <intro-header title="Yours Posts"
                      desc="Here you'll see yours posts."></intro-header>

        <section class="hero is-bold">
            <section class="hero is-bold">
                <div class="hero-body">
                    <div class="container">
                        <div class="columns">
                            <div class="column">
                                <post v-if="getMyPosts" v-for="p in getMyPosts"
                                      :p="p"
                                      :key="p.id">
                                </post>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </div>
</template>

<script>
    import IntroHeader from '../../../components/Intro.vue';
    import Posts from '../../../components/Posts.vue';

    export default {
        created(){
            if (!this.$store.getters.isLoggedIn) {
                this.$router.push({name: 'auth.login'});
            }

            this.$store.dispatch('getMyPosts');
        },

        components: {
            'intro-header': IntroHeader,
            'post': Posts,
        },

        computed: {
            getMyPosts() {
                return this.$store.getters.getMyPosts;
            }
        }
    }
</script>
