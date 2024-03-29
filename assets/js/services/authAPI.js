import axios from "axios";
import jwtDecode from "jwt-decode";
import {LOGIN_API} from "../config";

/**
 *
 * @param token
 */
function setAxiosToken(token) {
    axios.defaults.headers["Authorization"] = "Bearer " + token;
}

/**
 * @param credentials
 * @returns {Promise<AxiosResponse<any>>}
 */
function authenticate(credentials) {
    return axios.post(LOGIN_API, credentials)
        .then(response => response.data.token)
        .then(token => {
            window.localStorage.setItem("authToken", token);
            setAxiosToken(token);
        });
}

function logout() {
    window.localStorage.removeItem("authToken");
    delete axios.defaults.headers["Authorization"];
}


function setup() {
    const token = window.localStorage.getItem("authToken");
    if (token){
        const {exp : expiration} = jwtDecode(token);
        if(expiration * 1000 > new Date().getTime()){
            setAxiosToken(token);
            console.log("Connect to axios!");
        }
    }
}

/**
 *
 * @returns {boolean}
 */
function isAuthenticated() {
    const token = window.localStorage.getItem("authToken");
    if (token){
        const {exp : expiration} = jwtDecode(token);
        if(expiration * 1000 > new Date().getTime()){
            return true;
        }
        return false;
    }
    return false;
}

export default {
    authenticate,
    logout,
    setup,
    isAuthenticated
};