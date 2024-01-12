import React ,{useEffect,useState} from "react";
import Navbar from "../Navbar/Navbar";
import baseFun from "../../config/baseFun.js";
import dataHandler from "../../config/http.js";
export default function User(params) {
    
    useEffect(()=>{
        try {
            const UserID = {id:parseInt(window.location.href.split("#")[1])}  
            dataHandler.postDataAndHandle("getUserByID",UserID).then(res=>{
                if (res.data.lenght) {
                    
                }
                console.log(res.data.le);
            }).catch(err=>{
                console.log(err);
                //baseFun.redirect("/");
            })
        } catch (error) {
                console.log("nem jo");
        } 
    })

    

    return(<>
    <Navbar />
    </>)

}