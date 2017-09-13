<template>
    <div>
        <button class="button is-success is-outlined" @click="onClickShowForm">
            <span>New Post</span>
            <span class="icon is-small">
                                      <i class="fa fa-plus"></i>
                                    </span>
        </button>

        <article :class="{'media': true, 'is-hidden': hiddenForm}">
            <div class="media-content">

                <form :class="{'m-t-20': true}" @submit.prevent="sendPost">
                    <div class="field">
                        <div class="file is-info">
                            <label class="file-label">
                                <input v-validate="'required|image'"
                                       :class="{'file-input': true, 'is-danger': errors.has('photo') }"
                                       @change="onFileChange"
                                       name="photo" type="file">

                                <span class="file-cta">
                                <span class="file-icon"><i class="fa fa-upload"></i></span>
                                <span class="file-label">Post Image</span>
                            </span>
                            </label>
                        </div>

                        <div v-show="errors.has('photo')" class="help is-danger">
                            The post photo is required.
                        </div>
                    </div>

                    <div class="field">
                        <p class="control">
                        <textarea v-validate="'required'"
                                  v-model="post.text"
                                  :class="{'textarea': true, 'is-danger': errors.has('text') }"
                                  name="text"
                                  placeholder="Post text"></textarea>
                        </p>

                        <div v-show="errors.has('text')" class="help is-danger">
                            {{errors.first('text')}}
                        </div>
                    </div>
                    <nav class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <button type="submit" class="button is-info">Submit</button>
                            </div>
                        </div>
                    </nav>
                </form>

            </div>
        </article>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                formData: new FormData(),
                hiddenForm: true,
                post: {
                    text: '',
                    photo: {},
                },
            };
        },

        methods: {
            onClickShowForm(){
                this.hiddenForm = !this.hiddenForm;
            },

            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;

                if (!files.length)
                    return;

                this.post.photo = files[0];
            },

            sendPost() {
                let self = this;
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.formData.append('text', this.post.text);
                        this.formData.append('photo', this.post.photo);
                        this.formData.append('user_id', this.$store.getters.getUser.id);

                        this.$store.dispatch('sendPost', this.formData).then(() => {
                            self.$swal('Good job!',
                                'Post inserted',
                                'success');
                            self.errorsLaravel = '';
                            self.post.text = '';
                            self.post.photo = {};
                            self.onClickShowForm();
                        });
                    }
                });
            },

            getErrorLaravel (error) {
                let obj = error.errors;

                window._.forEach(obj, (v, k) => {
                    this.errors.add(k, v[0]);
                });

                alert(error.message);
            }
        },
    }
</script>
