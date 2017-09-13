import {routes as posts} from './posts';
import {routes as auth} from './auth';
import {routes as profile} from './profile';

export default [...posts, ...auth, ...profile];