// baseFun.js
import Cookies from "js-cookie";


const baseFun = {
    login: (jwt) => {
        Cookies.set("token", jwt);
    },
    logout: () => {
        Cookies.remove("token");
    },
    redirect: ( where) => {
        window.location.href = where;
    }
};

export default baseFun;
