import VueRouter from 'vue-router';
import routes from './routes';

const router = new VueRouter({
    routes
    , linkActiveClass: 'is-active'
});

export default router;