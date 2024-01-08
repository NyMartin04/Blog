import React ,{useEffect,useState} from "react";
import Navbar from "../Navbar/Navbar";

export default function User(params) {
    
    useEffect(()=>{
       console.log(window.location.href.split("#")[1]);
    })

    return(<>
    <Navbar />
    </>)

}