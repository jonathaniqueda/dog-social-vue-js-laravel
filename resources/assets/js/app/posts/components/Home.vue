<template>
    <div>

        <intro-header title="New Posts"
                      desc="Here you'll see yours feed with all new dogs posts."></intro-header>

        <section class="hero is-bold">
            <section class="hero is-bold">
                <div class="hero-body">
                    <div class="container">
                        <div class="columns">
                            <div class="column">
                                <show-form></show-form>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column">
                                <post v-if="getPosts" v-for="p in getPosts"
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
    import ShowForm from './Form/NewPost.vue';

    export default {
        created(){
            if (!this.$store.getters.isLoggedIn) {
                this.$router.push({name: 'auth.login'});
            }

            this.$store.dispatch('getPosts');
        },

        data() {
            return {
                posts: [],
                formData: new FormData(),
                post: {
                    text: '',
                    photo: {},
                    user_id: '',
                },
            };
        },

        components: {
            'intro-header': IntroHeader,
            'post': Posts,
            'show-form': ShowForm,
        },

        computed: {
            getPosts() {
                return this.$store.getters.getPosts;
            }
        }
    }
</script>
