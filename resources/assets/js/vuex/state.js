let states = {
    isLoggedIn: !!localStorage.getItem("token"),
    comments: [],
};

export default states;