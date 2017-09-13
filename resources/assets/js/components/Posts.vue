<template>
    <div class="box">

        <article class="media">

            <div class="media-left">
                <figure class="image is-128x128">
                    <img class="image-click" :src="p.image" alt="Image" @click="showModalImage = true;">
                    <image-modal v-show="showModalImage" :src="p.image" @close="showModalImage = false"></image-modal>
                </figure>
            </div>

            <div class="media-content">
                <div class="content">
                    <p>
                        <strong>{{p.fullname}}</strong>
                        <br>
                        <small>{{p.postDate}}</small>
                        <br>
                        {{p.text}}
                    </p>
                </div>

                <nav class="level is-mobile">
                    <div class="level-left">
                        <a class="level-item" @click="modalStart(p.id)">
                            <span class="icon is-small m-r-5">
                               <i class="fa fa-reply"></i>
                            </span>
                            Add comment
                        </a>
                    </div>
                </nav>

                <modal v-show="showModalPostsReply" :postId="p.id" @close="showModalPostsReply = false"></modal>

            </div>

        </article>
    </div>
</template>

<script>
    import Modal from './Modal.vue';
    import ImageModal from './ImageModal.vue';
    export default {
        props: {
            p: {
                type: Object,
                required: true
            },
        },

        methods: {
            modalStart(postId){
                let self = this;
                let token = localStorage.getItem('token');

                window.axios.get('comments/' + postId + '?token=' + token).then((response) => {
                    self.comments = response.data.comments;
                    self.$store.dispatch('startComments', self.comments);
                }).then(() => {
                    this.showModalPostsReply = true;
                }).catch(function (error) {
                    console.log('Error', error);
                });
            }
        },

        data() {
            return {
                showModalPostsReply: false,
                showModalImage: false,
                comments: [],
            };
        },

        components: {
            ImageModal,
            'modal': Modal,
            'image-modal': ImageModal,
        },
    }
</script>

<style type="text/css">
    .image-click {
        cursor: pointer;
    }
</style>