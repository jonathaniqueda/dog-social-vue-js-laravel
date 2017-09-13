import './bootstrap';
import router from './router/index';
import store from './vuex/index';

new Vue({
    router,
    store,
    el: '#app',

    data() {
        return {
            mobileMenu: false,
        }
    },

    created(){
        let self = this;

        this.$store.dispatch('checkToken').then((res) => {
            if (!res) {
                self.$router.push({name: 'auth.login'});
            }
        }).catch(() => {
            self.$router.push({name: 'auth.login'});
        });
    },

    methods: {
        onToggleMenu() {
            this.mobileMenu = !this.mobileMenu;
        },

        logout() {
            this.$store.dispatch('logout').then(() => {
                this.$router.push({name: 'auth.login'});
            });
        }
    },

    computed: {
        isLoggedIn() {
            return this.$store.getters.isLoggedIn;
        }
    }
});
