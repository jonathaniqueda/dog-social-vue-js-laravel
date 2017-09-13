import Vuex from 'vuex';
import state from './state';
import mutations from './mutations';
import actions from './actions';
import getters from './getters';
import modules from './modules';

const store = new Vuex.Store({
    state, mutations, actions, getters, modules
});

export default store;