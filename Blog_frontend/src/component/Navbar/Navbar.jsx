import React, { useEffect, useState } from 'react'

import logo from "../../assets/logo.png";
import bell from "../../assets/bell.png";
import Logout from "../../assets/logout.png";
import login from "../../assets/login.png";
import account from "../../assets/account.png";
import dataHandler from "../../config/http.js"
import Cookie from "../../config/cookieHandler.js";
import baseFun from '../../config/baseFun.js';
const Navbar = () => {

    const [isLogin, setIsLogin] = useState(false);
    const [searchValue, setSearchValue] = useState([]);


    useEffect(() => {
        if (Cookie.getCookie("token")) {
            // fetch.postData("verify", {}).then(data => {
            //     !data.err ? setIsLogin(true) : null;
            //     if (!data.err) {
            //         setIsLogin(true);
            //         Cookie.setCookie("token", data.JWT, { expires: 1800 })
            //     }
            // })
            dataHandler.postDataAndHandle("verify", {})
                .then(res => {
                    if (!res.err) {
                        setIsLogin(!res.err)
                        baseFun.login(res.JWT)

                    } else {
                        baseFun.logout()
                    }

                })
                .catch(err => {
                    console.error(err);
                })
        }
    }, [Cookie.getCookie("token")])
    const searchUser = (e) => {
        e.preventDefault();
        
        const data = {
            username: e.target.value
        }
        dataHandler.postDataAndHandle("getUserByUsername", data)
            .then(res => {
                if (res.data.length >= 1) {
                    setSearchValue(res.data);


                } else {

                    setSearchValue(false);
                }

            })
    }


    return (
        <div className='shadow-2xl'>
            <div className='flex justify-end items-center py-8 w-full bg-gray h-[5vh] '>
                <form className='mx-2' >
                    <input className='min-w-[100px] max-w-[130px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                        onChange={(e) => {
                            if (e.target.value.length >= 2) {
                                
                                searchUser(e)
                            } else {
                                setSearchValue(false);
                            }

                        }} type="text" placeholder='Search Blogger' />{searchValue !== false && <div className="absolute  min-h-[50px] bg-white rounded-md shadow-2xl w-auto grid grid-cols-1 ">
                            

                        {searchValue.map((item, index) => {
                            console.log(item);
                                return (
                                    <div key={index} className='flex justify-center items-center'>
                                        <div className='flex justify-between items-center hover:bg-white hover:text-black text-white bg-black min-w-[200px] px-3 py-1 max-w-[400px]'>
                                            <img src={item.url} alt=""/>
                                            <div className=''>{item.username}</div>
                                        </div>
                                    </div>
                                );
                            })}




                        </div>}</form>

                {isLogin && <a href='' className='text-white px-4 py-2 justify-center  hover:bg-black hover:rounded-lg'><img src={bell} alt="" className='h-[5vh] shadow-2xl' /></a>}
                {!isLogin && <a href='/sign' className='text-white px-4 py-2 justify-center  hover:bg-black hover:rounded-lg me-3 md:me-10'><img src={login} alt="" className='h-[5vh] shadow-2xl' /></a>}
                {isLogin && <a href='' className='text-white px-4 py-2 justify-center  hover:bg-black hover:rounded-lg'><img src={account} alt="" className='h-[5vh] shadow-2xl' /></a>}
                {isLogin && <a href='' onClick={() => { baseFun.logout() }} className='text-white px-4 py-2 justify-center  hover:bg-black hover:rounded-lgme-3 md:me-10'><img src={Logout} alt="" className='h-[5vh] shadow-2xl' /></a>}
            </div>

            <div className='grid grid-cols-1 md:grid-cols-2 min-h-[15vh] w-full justify-between items-center bg-white'>
                <div className='justify-start'><img src={logo} className=' md:h-[15vh]' alt="" /></div>
                <div className='grid grid-cols-1 md:grid-cols-3   justify-start'>
                    <a href='/' className='rounded-lg grid justify-center items-center  bg-red  hover:bg-red-400 my-2 md:my-0 md:mx-2 py-4'><button className='shadow-2xl text-white text-center'>Home</button></a>
                    {!isLogin && <a href='/sign' className='rounded-lg grid justify-center items-center  bg-red  hover:bg-red-400 my-2 md:my-0 md:mx-2 py-4'><button className='shadow-2xl text-white text-center'>Sign</button></a>}
                    {isLogin && <a href='/post' className='rounded-lg grid justify-center items-center  bg-red  hover:bg-red-400 my-2 md:my-0 md:mx-2 py-4'><button className='shadow-2xl text-white text-center'>Create Post</button></a>}
                </div>

            </div>
        </div>

    )
}

export default Navbar