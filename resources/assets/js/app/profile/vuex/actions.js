const MY_POSTS = "MY_POSTS";

let actions = {
    getMyPosts({commit, userId}) {
        let token = localStorage.getItem('token');

        return window.axios.get('my-posts?token=' + token).then(function (response) {
            let data = response.data;
            commit(MY_POSTS, data.posts);
        }).catch(function (error) {
            console.log('Error', error);
        });
    },
};

export default actions;