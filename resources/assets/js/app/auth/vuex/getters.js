let getters = {
    getAuthToken: state => {
        return state.token
    },
    getUser: state => {
        return state.user
    },
};

export default getters;