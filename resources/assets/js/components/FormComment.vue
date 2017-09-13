<template>
    <article class="media">

        <div class="media-content">
            <form @submit.prevent="registerComment(postId)">
                <div class="field">
                    <p class="control">
                    <textarea v-validate="'required'"
                              :class="{'textarea': true, 'is-danger': errors.has('body') }"
                              name="body" v-model="body"
                              placeholder="Add a comment..."></textarea>
                    </p>
                    <div v-show="errors.has('body')" class="help is-danger">{{ errors.first('body') }}</div>
                </div>

                <div class="field">
                    <p class="control">
                        <button class="button">Post comment</button>
                    </p>
                </div>
            </form>
        </div>

    </article>
</template>

<script>
    export default {
        props: {
            postId: {
                type: Number,
                required: true
            },
        },

        data(){
            return {
                body: '',
            }
        },

        methods: {
            registerComment(postId) {
                let self = this;
                let token = localStorage.getItem('token');

                this.$validator.validateAll().then((result) => {
                    if (result) {
                        window.axios.post('comments?token=' + token, {
                            post_id: postId,
                            user_id: self.$store.getters.getUser.id,
                            comment_parent: null,
                            body: self.body,
                        }).then(function (response) {
                            let comments = response.data.comments;
                            self.$store.dispatch('updateComments', comments);
                            self.body = '';
                        }).catch(function (error) {
                            console.log('Error', error);
                        });

                        return;
                    }

                    alert('Correct them errors!');
                });
            },
        },
    }
</script>