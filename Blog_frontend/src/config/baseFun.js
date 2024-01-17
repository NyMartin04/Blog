// baseFun.js
import Cookies from "js-cookie";


const baseFun = {
    saveUserData:({username,userId,email,PPUrl})=>{
        localStorage.setItem("userID",userId);
        localStorage.setItem("username",username);
        localStorage.setItem("email",email);
        localStorage.setItem("PPUrl",PPUrl);
    },
    getUserIDFromLS:()=>{
        return {id:localStorage.getItem("userID"),username:localStorage.getItem("username"),email:localStorage.getItem("email"),PPUrl:localStorage.getItem("PPUrl")};
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
