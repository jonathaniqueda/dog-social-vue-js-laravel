<style type="text/css">
    .border-bottom {
        border-bottom: 1px solid rgba(219, 219, 219, 0.5);
    }

    .remove-border {
        border: none !important;
    }
</style>

<template>
    <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="box">
                <form-comment :postId="postId"></form-comment>

                <article v-if="getComments" v-for="c in getComments" class="media">
                    <div class="media-content">
                        <div class="content border-bottom">
                            <p class="m-b-10">
                                <strong>{{c.creator.name}}</strong>
                                <br>
                                {{c.body}}
                                <br>
                            </p>
                        </div>

                        <div v-if="c.children" v-for="children in c.children">
                            <article class="media m-l-50 remove-border">
                                <div class="media-content">
                                    <div class="content">
                                        <p>
                                            <strong>{{children.creator.name}}</strong>
                                            <br>
                                            {{children.body}}
                                            <br>
                                        </p>
                                    </div>
                                </div>
                            </article>
                        </div>

                    </div>
                </article>

            </div>
        </div>
        <button class="modal-close is-large" aria-label="close" @click="$emit('close')"></button>
    </div>
</template>

<script>
    import FormComment from './FormComment.vue';

    export default {
        props: {
            postId: {
                type: Number,
                required: true
            },
        },

        components: {
            'form-comment': FormComment,
        },

        computed: {
            getComments() {
                return this.$store.getters.getComments;
            }
        }
    }
</script>