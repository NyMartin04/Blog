import React from 'react'
import Navbar from "../Navbar/Navbar"
import TopBlogger from "../TopBlogger/TopBlogger";
import AllBlogger from "../AllBlogger/allBlogger";
import Kep from "../../assets/porsche.jpg"
const Home = () => {
  return (
    <>
    <Navbar/>
    <TopBlogger/>
    <img src={Kep} className=' object-cover h-[100vh] md:object-fill md:w-screen md:h-auto opacity-80' alt="" />
    <AllBlogger />
    </>
    
  )
}

export default Home