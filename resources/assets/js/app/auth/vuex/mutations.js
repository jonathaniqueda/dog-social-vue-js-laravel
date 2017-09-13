const AUTH_CONFIG = "AUTH_CONFIG";
const AUTH_CONFIG_LOGOUT = "AUTH_CONFIG_LOGOUT";

let mutations = {
    [AUTH_CONFIG] (state, obj) {
        state.user = obj.user;
        state.token = obj.token;
    },
    [AUTH_CONFIG_LOGOUT](state) {
        state.user = {};
        state.token = '';
    }
};

export default mutations;