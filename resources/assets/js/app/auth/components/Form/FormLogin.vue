<template>

    <form @submit.prevent="doLogin">
        <div class="field">
            <p class="control has-icons-left has-icons-right">
                <input v-validate="'required|email'"
                       :class="{'input': true, 'is-danger': errors.has('email') }"
                       name="email" v-model="user.email" type="text"
                       placeholder="e.g. alexsmith@gmail.com">
                <span class="icon is-small is-left"> <i class="fa fa-envelope"></i> </span>
            </p>
            <div v-show="errors.has('email')" class="help is-danger">{{ errors.first('email') }}</div>
        </div>

        <div class="field">
            <p class="control has-icons-left">
                <input v-validate="'required'"
                       :class="{'input': true, 'is-danger': errors.has('password') }"
                       name="password" v-model="user.password" type="password"
                       placeholder="******">
                <span class="icon is-small is-left"> <i class="fa fa-lock"></i> </span>
            </p>

            <div v-show="errors.has('password')" class="help is-danger">{{ errors.first('password') }}</div>
        </div>

        <div class="field">
            <p class="control">
                <button class="button is-success">
                    Login
                </button>
            </p>
            <p class="control m-t-5">
                <router-link :to="{ name: 'auth.register' }">
                    Create Account
                </router-link>
            </p>
        </div>
    </form>

</template>


<script>
    import axios from 'axios';

    export default {
        data(){
            return {
                errorsLaravel: {},
                user: {
                    name: '',
                    email: '',
                }
            }
        },

        methods: {
            doLogin() {
                const self = this;

                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.$store.dispatch("login", {
                            email: self.user.email,
                            password: self.user.password
                        }).then(() => {
                            this.$router.push({name: 'posts.index'});
                            self.$swal('Logged!', 'See all posts.', 'success');
                        });

                        return;
                    }

                    alert('Correct them errors!');
                });
            },
        },
    }
</script>