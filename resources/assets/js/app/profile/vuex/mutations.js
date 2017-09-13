const MY_POSTS = "MY_POSTS";

let mutations = {
    [MY_POSTS] (state, obj) {
        state.myPosts = obj;
    },
};

export default mutations;