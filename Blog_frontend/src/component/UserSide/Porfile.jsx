import React, { useEffect, useState } from "react";
import Navbar from "../Navbar/Navbar";
import baseFun from "../../config/baseFun";
import dataHandler from "../../config/http.js"

function Friend() {

    const [Follow, setFollow] = useState([]);
    const [Follower, setFollower] = useState([]);
    const [Switch, setSwitch] = useState(true);

    useEffect(() => {

        dataHandler.postDataAndHandle("getFollowByUserId").then(res=>{
            console.log(res);
        }).catch(err=>{
            console.error(err);
        })
        dataHandler.postDataAndHandle("getFollowerByUserId").then(res=>{
            console.log(res);
        }).catch(err=>{
            console.error(err);
        })

            setFollow([{ id: 0, username: "Username1", PPFile: "http://localhost/Blog/system/config/FILES/icons8-json-download-100(0).png" }])
        
            setFollower([{ id: 0, username: "Username2", PPFile: "http://localhost/Blog/system/config/FILES/icons8-json-download-100(0).png" }])
        
    }, [])

    return (
    <div>
        <div className="h-[10vh] w-[100%]  flex justify-between items-start">
            <button className="w-[40%] h-[8vh] p-[1vh] rounded-lg bg-red-300 hover:bg-red-100 ml-2 mt-2" onClick={()=>setSwitch(true)}>Follow</button>
            <button className="w-[40%] h-[8vh] p-[1vh] rounded-lg bg-red-300 hover:bg-red-100 mr-2 mt-2" onClick={()=>setSwitch(false)}>Follower</button>
        </div>    
        <div>
            {Switch && <div> {Follow.map((item,index)=>{
                return item.username
            })}</div>}
            {!Switch && <div> {Follower.map((item,index)=>{
                return item.username
            })}</div>}
        </div>    
    </div>)
}
function ProfilePost() {
    const [post,setPost]=useState([]);
    useEffect(()=>{
        dataHandler.postDataAndHandle("getPostByUserID",{id:baseFun.getUserIDFromLS().id}).then(res=>{
            
            if (!res.err) {
               console.log(res.data);
            setPost(res.data); 
            }
        }).catch(err=>{
            console.error(err);
        })
    },[])
    return (<div className="grid grid-cols-1 "><h1>Profile side</h1>
    <div className="overflow-y-auto max-h-[50vh]">
    {Array.isArray(post) && post.map((item,index)=>{
        return <div className="flex justify-between items-start m-6" key={"post"+index}>
            <div className="min-w-[20vw]"><img src={item.url} alt="" className="w-auto h-[50vh]"/></div>
            <div className="grid grid-cols-1 w-[100%]">
                <h1>{item.title}</h1>
                <div className="overflow-y-auto max-h-[25vh]">{item.text}</div>
            </div>
        </div>
    })}
    {!Array.isArray(post) && <div>Nincs Post </div>}
    </div>
    </div>)
}

export default function Profile() {

    const [profile, setProfile] = useState();
    useEffect(() => {
        if (baseFun.getUserIDFromLS().id !== null) {
            try {
                const UserID = { id: parseInt(baseFun.getUserIDFromLS().id) }
                dataHandler.postDataAndHandle("getUserByID", UserID).then(res => {

                    console.log(res.data[0]);
                    setProfile(res.data[0]);
                }).catch(err => {
                    console.log(err);
                    //baseFun.redirect("/");
                })
            } catch (error) {
                console.log(error);
            }
        }
        else {
            baseFun.redirect("/");
        }

    }, [])

    return (
        <>
            <Navbar />
            <section className="w-[100%] min-h-[80vh] bg-red flex justify-center">
                <div className="w-[80%] min-h-[80vh] bg-white mt-6 mb-6 rounded-xl">
                    <header className=" h-[20vh]  border-b-4 border-red-400">
                        <div className="flex justify-start items-center ">
                            <img src={baseFun.getUserIDFromLS().PPUrl} alt="" className="rounded-full h-[18vh] m-[1vh] border-dashed border-2 border-black" />
                            <h2 className="text-3xl text-red-400">{baseFun.getUserIDFromLS().username}</h2>
                        </div>
                    </header>
                    <section className="flex justify-between items-start">
                        <div className="w-[30%] min-h-[60vh] border-4 border-red-400">
                            <Friend />
                        </div>
                        <div className="w-[70%] min-h-[60vh]">
                            <ProfilePost />
                        </div>
                    </section>
                </div>
            </section>
        </>

    )
}