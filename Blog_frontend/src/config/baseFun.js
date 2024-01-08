// baseFun.js
import Cookies from "js-cookie";


const baseFun = {
    saveUserData:({username,userId,email})=>{
        localStorage.setItem("userID",userId);
        localStorage.setItem("username",username);
        localStorage.setItem("email",email);
    },
    getUserIDFromLS:()=>{
        return {id:localStorage.getItem("userID"),username:localStorage.getItem("username"),email:localStorage.getItem("email")};
    },
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
