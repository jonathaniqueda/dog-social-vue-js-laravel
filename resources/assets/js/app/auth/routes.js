import LoginPage from './components/Login.vue';
import RegisterPage from './components/Register.vue';

let routes = [
    {

        path: '/login'
        , component: LoginPage
        , name: 'auth.login'

    },
    {

        path: '/register'
        , component: RegisterPage
        , name: 'auth.register'

    },
];

export default routes;