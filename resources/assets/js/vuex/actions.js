const LOGIN = "LOGIN";
const LOGIN_SUCCESS = "LOGIN_SUCCESS";
const LOGOUT = "LOGOUT";
const AUTH_CONFIG = "AUTH_CONFIG";
const AUTH_CONFIG_LOGOUT = "AUTH_CONFIG_LOGOUT";
const COMMENTS = "COMMENTS";
const START_COMMENTS = "START_COMMENTS";

let actions = {
    checkToken({commit}) {
        let token = localStorage.getItem('token');

        if (token == '' || token == null) {
            return false;
        }

        return window.axios.get('auth/check?token=' + token).then(function (response) {
            let data = response.data;
            localStorage.setItem("token", data.token);

            commit(LOGIN_SUCCESS);
            commit(AUTH_CONFIG, {
                user: data.user,
                token: data.token,
            });
        }).catch(function (error) {
            console.log('Error', error);

            localStorage.removeItem("token");
            commit(LOGOUT);
            commit(AUTH_CONFIG_LOGOUT);
        });
    },

    login({commit}, creds) {
        commit(LOGIN);

        return window.axios.post('auth/login', {
            email: creds.email,
            password: creds.password,
        }).then(function (response) {
            let data = response.data;

            if (data.status == 'warning') {
                self.$swal('Opss...', data.msg, 'error');
            } else {
                localStorage.setItem("token", data.token);
                commit(LOGIN_SUCCESS);
                commit(AUTH_CONFIG, {
                    user: data.user,
                    token: data.token,
                });
            }
        }).catch(function (error) {
            console.log('Error', error);
        });
    },

    logout({commit}) {
        localStorage.removeItem("token");
        commit(LOGOUT);
        commit(AUTH_CONFIG_LOGOUT);
    },

    updateComments({commit}, comments) {
        commit(COMMENTS, comments);
    },

    startComments({commit}, comments) {
        commit(START_COMMENTS, comments);
    }
};

export default actions;