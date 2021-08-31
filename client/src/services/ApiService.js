import axios from "axios";
import env from "../config/env";

export default () => {
    return axios.create({
        baseURL: env.baseURL + "/api/",
    });
};