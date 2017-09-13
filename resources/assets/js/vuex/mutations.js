const LOGIN = "LOGIN";
const LOGIN_SUCCESS = "LOGIN_SUCCESS";
const LOGOUT = "LOGOUT";
const COMMENTS = "COMMENTS";
const START_COMMENTS = "START_COMMENTS";

let mutations = {
    [LOGIN] (state) {
        state.pending = true;
    },
    [LOGIN_SUCCESS] (state) {
        state.isLoggedIn = true;
        state.pending = false;
    },
    [LOGOUT](state) {
        state.isLoggedIn = false;
    },
    [COMMENTS](state, comments) {
        state.comments = comments;
    },
    [START_COMMENTS](state, comments) {
        state.comments = comments;
    }
};

export default mutations;