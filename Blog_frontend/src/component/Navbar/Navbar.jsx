import React, { useEffect, useState } from 'react'

import logo from "../../assets/logo.png";
import bell from "../../assets/bell.png";
import Logout from "../../assets/logout.png";
import login from "../../assets/login.png";
import account from "../../assets/account.png";
import fetch from "../../config/http.js";
import Cookie from "../../config/cookieHandler.js";
const Navbar = () => {

    const [isLogin, setIsLogin] = useState(false);

    useEffect(() => {
        if (Cookie.getCookie("token")) {
            fetch.postData("UserController.php/verify", {}).then(data => {
                !data.err ? setIsLogin(true) : null;
                if (!data.err) {
                    setIsLogin(true);
                    Cookie.setCookie("token", data.JWT, { expires: 1800 })
                }
            })
        }
    }, [Cookie.getCookie("token")])

    return (
        <div className='shadow-2xl'>
            <div className='flex justify-end items-center py-8 w-full bg-gray h-[5vh]'>
                {isLogin &&<a href='' className='text-white px-4 py-2 justify-center  hover:bg-black hover:rounded-lg'><img src={bell} alt="" className='h-[5vh] shadow-2xl' /></a>}
                {!isLogin &&<a href='/sign' className='text-white px-4 py-2 justify-center  hover:bg-black hover:rounded-lg me-3 md:me-10'><img src={login} alt="" className='h-[5vh] shadow-2xl' /></a>}
                {isLogin &&<a href='' className='text-white px-4 py-2 justify-center  hover:bg-black hover:rounded-lg'><img src={account} alt="" className='h-[5vh] shadow-2xl' /></a>}
                {isLogin &&<a href='' className='text-white px-4 py-2 justify-center  hover:bg-black hover:rounded-lgme-3 md:me-10'><img src={Logout} alt="" className='h-[5vh] shadow-2xl' /></a>}
            </div>
            <div className='grid grid-cols-1 md:grid-cols-2 min-h-[15vh] w-full justify-between items-center bg-white'>
                <div className='justify-start'><img src={logo} className=' md:h-[15vh]' alt="" /></div>
                <div className='grid grid-cols-1 md:grid-cols-3   justify-start'>
                 <a href='/' className='rounded-lg grid justify-center items-center  bg-red  hover:bg-red-400 my-2 md:my-0 md:mx-2 py-4'><button className='shadow-2xl text-white text-center'>Home</button></a>
                {!isLogin &&<a href='/sign' className='rounded-lg grid justify-center items-center  bg-red  hover:bg-red-400 my-2 md:my-0 md:mx-2 py-4'><button className='shadow-2xl text-white text-center'>Sign</button></a>}
                {isLogin &&<a href='#' className='rounded-lg grid justify-center items-center  bg-red  hover:bg-red-400 my-2 md:my-0 md:mx-2 py-4'><button className='shadow-2xl text-white text-center'>Create Post</button></a>}
            </div>

            </div>
        </div>

    )
}

export default Navbar