import { createApp } from 'vue'
import App from './App.vue'
import API from "./config/API";
import axios from "axios";
import env from "./config/env";
import router from './router/index.js'
import Store from "./config/Store";
import './assets/style.css'
// baseURL(server) for axios 
axios.defaults.baseURL = env.baseURL;
// allowing axios, api and store to be used in the global scope
window.axios = axios;
window.API = API;
window.Store = Store;
let access_token = Store.getters.getAccessToken;
if (access_token) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${access_token}`;
}
// creating the app
const app = createApp(App);
app.use(Store);
app.use(router);
app.mount("#app");