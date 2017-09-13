import {routes as app} from '../app/index';

const root = {
    path: '/', redirect: 'posts'
};

export default [root, ...app];