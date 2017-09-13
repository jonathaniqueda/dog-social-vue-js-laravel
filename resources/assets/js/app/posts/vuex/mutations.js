const NEW_POST = "NEW_POST";
const SET_POSTS = "SET_POSTS";

let mutations = {
    [NEW_POST] (state, obj) {
        state.posts = [obj.obj, ...state.posts];
    },
    [SET_POSTS] (state, obj) {
        state.posts = obj;
    },
};

export default mutations;