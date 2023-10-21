import React, {useState,useEffect} from 'react';
import "./Home.css"
import Navbar from '../Navbar/Navbar';
import Footer from '../Footer/Footer';
import Bloggers from "../Bloggers/Bloggers.js"
import AllBlogger from "../AllBlogger/AllBlogger.js"
import car1 from "../../images/car1.jpg";
function Home() {
   const [bestBlogger,setBestBlogger] = useState({});
   useEffect(()=>{
      setBestBlogger({});
   },[])
   return(<div className='Home_body'>
      <Navbar/>
      <Bloggers bloggers ={bestBlogger}></Bloggers>
      <section className='pc-car'>
         <img  className='img' src={car1} />
      </section>
      <AllBlogger />
      <Footer fixed={"noFix"} />
   </div>)
} 


export default Home;
