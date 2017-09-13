<template>

    <form @submit.prevent="submitRegister">
        <div class="field">
            <label class="label">Name</label>
            <div class="control">
                <input v-validate="'required'"
                       :class="{'input': true, 'is-danger': errors.has('name') }"
                       name="name" v-model="user.name" type="text"
                       placeholder="e.g Alex Smith">
                <div v-show="errors.has('name')" class="help is-danger">{{ errors.first('name') }}</div>
            </div>
        </div>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input v-validate="'required|email'"
                       :class="{'input': true, 'is-danger': errors.has('email') }"
                       name="email" v-model="user.email" type="text"
                       placeholder="e.g. alexsmith@gmail.com">
                <div v-show="errors.has('email')" class="help is-danger">{{ errors.first('email') }}</div>
            </div>
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input v-validate="'required'"
                       :class="{'input': true, 'is-danger': errors.has('password') }"
                       name="password" v-model="user.password" type="password"
                       placeholder="******">
                <div v-show="errors.has('password')" class="help is-danger">{{ errors.first('password') }}</div>
            </div>
        </div>

        <div class="field">
            <label class="label">Confirm Password</label>
            <div class="control">
                <input v-validate="'required|confirmed:password'"
                       :class="{'input': true, 'is-danger': errors.has('password_confirmation') }"
                       name="password_confirmation" v-model="user.password_confirmation" type="password"
                       placeholder="******">
                <div v-show="errors.has('password_confirmation')" class="help is-danger">
                    The password confirmation is required and has to match password.
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label">Profile Picture</label>

            <div class="file is-info">
                <label class="file-label">
                    <input v-validate="'required|image'"
                           :class="{'file-input': true, 'is-danger': errors.has('profile_pic') }"
                           @change="onFileChange"
                           name="profile_pic" type="file">

                    <span class="file-cta">
                        <span class="file-icon"><i class="fa fa-upload"></i></span>
                        <span class="file-label">Profile Picture Goes Here</span>
                    </span>
                </label>
            </div>

            <div v-show="errors.has('profile_pic')" class="help is-danger">
                The profile picture is required.
            </div>
        </div>

        <div class="field">
            <p class="control">
                <button class="button is-success m-t-10">
                    Create Account
                </button>
            </p>
        </div>
    </form>

</template>

<script>
    import axios from 'axios';
    import swal from 'sweetalert2';

    export default {
        data(){
            return {
                formData: new FormData(),
                errorsLaravel: {},
                user: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    image: [],
                },
            }
        },

        methods: {
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;

                if (!files.length)
                    return;

                this.user.image = files[0];
            },

            submitRegister() {
                const self = this;

                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.formData.append('email', this.user.email);
                        this.formData.append('name', this.user.name);
                        this.formData.append('profile_pic', this.user.image);
                        this.formData.append('password', this.user.password);
                        this.formData.append('password_confirmation', this.user.password_confirmation);

                        const config = {
                            baseURL: 'http://local.dogshare.com.br/api/v1/',
                            timeout: 999999,
                            headers: {
                                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]'),
                                'X-Requested-With': XMLHttpRequest,
                                'Content-Type': 'multipart/form-data',
                            }
                        };

                        axios.post('auth/register', this.formData, config)
                            .then(function (response) {
                                self.$router.push({name: 'auth.login'});
                                self.$swal('Good job!',
                                    'User created! Please login to continue on system.',
                                    'success');
                                self.errorsLaravel = '';
                            })
                            .catch(function (error) {
                                if (error.response && error.response.status == 422) {
                                    self.getErrorLaravel(error.response.data);
                                } else {
                                    console.log('Error', error.message);
                                }
                            });

                        return;
                    }

                    alert('Correct them errors!');
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