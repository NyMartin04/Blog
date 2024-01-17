import React ,{useEffect,useState} from "react";
import Navbar from "../Navbar/Navbar";
import baseFun from "../../config/baseFun.js";
import dataHandler from "../../config/http.js";
export default function User(params) {


    const [user,setUser] = useState([]);

    useEffect(()=>{
        try {
            const UserID = {id:parseInt(window.location.href.split("#")[1])}  
            dataHandler.postDataAndHandle("getUserByID",UserID).then(res=>{
            
                console.log(res.data[0]);
                setUser(res.data[0]);
            }).catch(err=>{
                console.log(err);
                //baseFun.redirect("/");
            })
        } catch (error) {
                console.log("nem jo");
        } 
    },[])

    

    return(<>
    <Navbar />
        {<div><img src={user.url}/>{user.username}</div>}
    </>)

}