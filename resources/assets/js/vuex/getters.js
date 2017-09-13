let getters = {
    isLoggedIn: state => {
        return state.isLoggedIn
    },
    getComments: state => {
        return state.comments
    },
};

export default getters;