import React, { useState } from 'react'

import Navbar from '../Navbar/Navbar'

import loginPNG from "../../assets/login.png"
import signupPNG from "../../assets/signup.png"

import fetch from "../../config/http.js"
import Cookie from "../../config/cookieHandler.js"

const Login = () => {
    const state = {
        email: "",
        password: ""
    }
    const submit = (e) => {
        e.preventDefault();
        fetch.postData("UserController.php/login", state).then(data => {
            console.log(data);
        }).catch(err => {
            console.log(err);
        });
    }
    return (<form className=" w-full  bg-gray my-6 p-10 rounded-2xl" onSubmit={(e)=>{
        e.preventDefault();
        submit(e)
    }}>
        <div className="relative z-0 w-full md:w-[50vw] mb-5 group">
            <input onChange={(e) => { state.email = e.target.value }} type="email" name="email" id="email" className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label htmlFor="email" className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
        </div>

        <div className="relative z-0 w-full md:w-[50vw] mb-5 group">
            <input onChange={(e) => { state.password = e.target.value }} type="password" name="password" id="password" className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <label htmlFor="password" className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
        </div>



        <button type="submit" className="text-white bg-red hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>)
}
const SignUp = () => {
    const state = {
        email: "",
        username: "",
        password: "",
        repassword: ""
    }
    const submit = (e) => {
        e.preventDefault();
        if (state.repassword === state.password) {
            const data = {
                email: state.email,
                username: state.username,
                password: state.password,
            }
            fetch.postData("UserController.php/sign", data).then(data => {
                console.log(data);
            }).catch(err => {
                console.log(err);
            });
        }

    }
    return (

        <form className=" w-full  bg-gray my-6 p-10 rounded-2xl" onSubmit={(e)=>{ 
            e.preventDefault();
            submit(e)
            }}>
            <div className="relative z-0 w-full md:w-[50vw] mb-5 group">
                <input onChange={(e) => { state.email = e.target.value }} type="email" name="email" id="email" className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label htmlFor="email" className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
            </div>
            <div className="relative z-0 w-full md:w-[50vw] mb-5 group">
                <input onChange={(e) => { state.username = e.target.value }} type="text" name="username" id="username" className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label htmlFor="username" className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
            </div>
            <div className="relative z-0 w-full md:w-[50vw] mb-5 group">
                <input onChange={(e) => { state.password = e.target.value }} type="password" name="password" id="password" className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label htmlFor="password" className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
            </div>
            <div className="relative z-0 w-full md:w-[50vw] mb-5 group">
                <input onChange={(e) => { state.repassword = e.target.value }} type="password" name="repassword" id="floating_repassword" className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                <label htmlFor="floating_repassword" className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm password</label>
            </div>


            <button type="submit" className="text-white bg-red hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    )
}

const sign = () => {

    const [isLogin, setIsLogin] = useState(true);

    return (
        <>
            <Navbar></Navbar>
            <div className='md:flex justify-center items-center w-screen rounded-2xl'>
                <div className={!isLogin ? "w-[100vw] md:w-[10vw] min-h-[5vh] md:min-h-[60vh] bg-gray md:rounded-ss-2xl md:rounded-es-2xl grid justify-center items-center" : "w-[100vw] md:w-[70vw] min-h-[20vh] md:min-h-[60vh] bg-red md:rounded-ss-2xl md:rounded-es-2xl grid justify-center items-center"} onClick={() => {
                    if (!isLogin) {
                        setIsLogin(!isLogin)
                    }
                }}>{isLogin ? <Login /> : <div className='grid grid-cols-1 justify-center items-center text-center text-white'><img className='h-auto w-[10vh] md:w-[15vh]' src={loginPNG}></img>LOGIN</div>}</div>
                <div className={isLogin ? "w-[100vw] md:w-[10vw] min-h-[5vh] md:min-h-[60vh] bg-gray md:rounded-ee-2xl md:rounded-se-2xl grid justify-center items-center" : "w-[100vw] md:w-[70vw] min-h-[20vh] md:min-h-[60vh] bg-red md:rounded-ee-2xl md:rounded-se-2xl grid justify-center items-center"} onClick={() => {
                    if (isLogin) {
                        setIsLogin(!isLogin)
                    }
                }}>{!isLogin ? <SignUp /> : <div className='grid grid-cols-1 justify-center items-center text-center text-white'><img className='h-auto w-[10vh] md:w-[15vh]' src={signupPNG}></img>SIGNUP</div>}</div>
            </div>
        </>
    )
}

export default sign