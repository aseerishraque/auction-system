import { createApp } from "vue";
import { createStore } from "vuex";
import axios from "axios";
import App from "../App.vue";
import createPersistedState from "vuex-persistedstate";
import env from "./env";

const Store = createStore({
    plugins: [createPersistedState()],
    state() {
        return {
            tokens: {},
            currentUser: null,
        };
    },
    actions: {
        login(context, user) {
            return new Promise((resolve, reject) => {
                let data = {
                    client_id: env.CLIENT_ID,
                    client_secret: env.CLIENT_SECRET,
                    grant_type: "password",
                    username: user.email,
                    password: user.password,
                };

                axios
                    .post(API.login, data)
                    .then((response) => {
                        let login_response = response.data;

                        context.commit("updateTokens", login_response);
                        axios.defaults.headers.common[
                            "Authorization"
                        ] = `Bearer ${login_response.access_token}`; // passing the token to axios header

                        resolve(response);
                    })
                    .catch((login_error) => {
                        reject(login_error);
                    });
            });
        },

        getCurrentUser(context) {
            return new Promise((resolve, reject) => {
                axios
                    .get(API.user)
                    .then((response) => {
                        let user_response = response.data;
                        context.commit("updateCurrentUser", user_response);
                        resolve(response);
                    })
                    .catch((user_error) => {
                        reject(user_error);
                    });
            });
        },

        logout(context) {
            return new Promise((resolve, reject) => {
                context.commit("logout");
                delete axios.defaults.headers.common["Authorization"]; // deleting token from axios
                resolve();
            }).catch((login_error) => {
                reject(login_error);
            });
        },

        toggleSidebar(context) {
            context.commit('updateSidebarState');
        },

        closeSidebar(context) {
            context.commit('closeSidebar');
        }
    },
    mutations: {
        updateTokens(state, tokens) {
            state.tokens = tokens;
        },

        setDeposit(state, payload){
            state.currentUser.deposit = payload.deposit;
        },
        
        updateCurrentUser(state, currentUser) {
            state.currentUser = currentUser;
        },

        logout(state) {
            state.currentUser = null;
            state.tokens = {};
        },

        updateSidebarState(state) {
            state.isSidebarOpen = !state.isSidebarOpen;
        },

        closeSidebar(state) {
            state.isSidebarOpen = false;
        }
    },
    getters: {
        getAccessToken(state) {
            return state.tokens.access_token;
        },
        getCurrentUser(state) {
            return state.currentUser;
        },
        getSidebarState(state) {
            return state.isSidebarOpen;
        }
    },
});

const app = createApp(App);
app.use(Store);

export default Store;