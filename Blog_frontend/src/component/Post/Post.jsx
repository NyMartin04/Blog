import React, { useEffect, useState } from "react";
import Navbar from "../Navbar/Navbar.jsx";
import baseFun from "../../config/baseFun.js";
import dataHandler from "../../config/http.js"
export default function Post() {


    const [count, setCount] = useState(0);
    const initialData = {
        title: null,
        text: null,
        userID: baseFun.getUserIDFromLS().id,
        carName: null,
        carBrand: null,
        IsFile: false,
        file: {
            content: null,
            name: null,
            userID: baseFun.getUserIDFromLS().id,
            extension: null,
            type: null,
            size: null
        }
    };

    const [state, setState] = useState(initialData);
    const max = 5;
    const nextCount = () => {
        setCount(count + 1);
    }
    const lastCount = () => {
        setCount(count - 1);
    }
    const submitItem = () => {
        dataHandler.postDataAndHandle("createPost", state).then(res => {
            res.err ? alert(res.data) : baseFun.redirect("/");
        }).catch(err => {
            console.log(err);
        })
    }
    const handleFileChange = async (e) => {
        const selectedFile = e.target.files[0];

        try {
            const base64Content = await readFileAsync(selectedFile);

            // Frissítjük a file állapotot a kiválasztott fájl adataival
            setState({ ...state, IsFile: 1 })
            setState({
                ...state,
                file: {
                    content: base64Content,
                    name: selectedFile.name.split(".")[0],
                    userID: baseFun.getUserIDFromLS().id,
                    extension: selectedFile.name.split('.').pop(),
                    type: selectedFile.type.split("/")[0],
                    size: selectedFile.size
                }
            });

        } catch (error) {
            console.error('Hiba történt a fájl beolvasása során:', error);
        }
    };

    const readFileAsync = (file) => {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onloadend = () => resolve(reader.result.split(',')[1]);
            reader.onerror = reject;
            reader.readAsDataURL(file);
        });
    };
    useEffect(() => {
        var min = 0;
        // console.log(state);
        while (min != max) {
            if (count !== min) {
                document.getElementById(`count${min}`).classList.contains("hidden") ? true : document.getElementById(`count${min}`).classList.add("hidden");
            } else {
                document.getElementById(`count${min}`).classList.contains("hidden") ? document.getElementById(`count${min}`).classList.remove("hidden") : true;
            }
            min++;
        }



    }, [count])
    useEffect(() => {
        console.log(state);
    }, [state.file.content])
    return (
        <>
            <Navbar />
            <div>
                <div className="w-[100%] h-[70vh] grid grid-cols-1 bg-red" id="count0">

                    <div className="h-[50vh]">
                        <form className="grid grid-cols-1">
                            <div className="flex justify-center items-center mt-[20%]">
                                <h2 className="text-center font-black text-2xl text-white">Post Title</h2>
                                <input type="text" className="w-96 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" onChange={(e) => {
                                    setState({ ...state, title: e.target.value })
                                    console.log(state);
                                }} />
                            </div>

                        </form>
                    </div >
                    <div className="grid grid-cols-2 w-full h-[20vh]">
                        <button ></button>
                        <button onClick={nextCount}>next</button>
                    </div>

                </div>
                <div className="w-[100%] h-[70vh] grid grid-cols-1 bg-red hidden" id="count1">

                    <div className="h-[50vh]">

                        <form className="grid grid-cols-1 justify-center items-center">
                            <h2 className="text-center font-black text-2xl text-white">Car Type Name</h2>
                            <input type="text" className="w-96 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" onChange={(e) => {
                                setState({ ...state, carName: e.target.value })
                                console.log(state);
                            }} />
                            <h2 className="text-center font-black text-2xl text-white">Car Brand Name</h2>
                            <input type="text" className="w-96 text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" onChange={(e) => {
                                setState({ ...state, carBrand: e.target.value })
                                console.log(state);
                            }} />
                        </form>
                    </div>
                    <div className=" grid grid-cols-2 w-full h-[20vh]">
                        <button onClick={lastCount}>last</button>
                        <button onClick={nextCount}>next</button>
                    </div>

                </div>
                <div className="w-[100%] h-[70vh] grid grid-cols-1 bg-red hidden" id="count2">

                    <div className="h-[50vh]">
                        <form className="grid grid-cols-1 justify-center items-center">
                            <h1>Post Text</h1>
                            <textarea id="message" rows="4" className="block p-2.5 w-full h-[50vh] text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                onChange={(e) => {
                                    setState({ ...state, text: e.target.value })
                                    console.log(state);
                                }}
                                placeholder="Write your thoughts here..."></textarea>

                        </form>

                    </div>
                    <div className=" grid grid-cols-2 w-full h-[20vh]">
                        <button onClick={lastCount}>last</button>
                        <button onClick={nextCount}>next</button>
                    </div>

                </div>
                <div className="w-[100%] h-[70vh] grid grid-cols-1 bg-red hidden" id="count3">

                    <div className="h-[50vh]">
                        <form className="grid grid-cols-1 justify-center items-center">

                            <input
                                className="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="file_input"
                                type="file"
                                onChange={handleFileChange}
                            />

                        </form>
                    </div>
                    <div className=" grid grid-cols-2 w-full h-[20vh]">
                        <button onClick={lastCount}>last</button>
                        <button onClick={nextCount}>next</button>
                    </div>

                </div>
                <div className="w-[100%] h-[70vh] grid grid-cols-1 bg-red hidden" id="count4">

                    <div className="grid grid-cols-1 h-[50vh]">

                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Title
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Text
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Car
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            File
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {state.title}
                                        </th>
                                        <td class="px-6 py-4">
                                            {state.text}
                                        </td>
                                        <td class="px-6 py-4">
                                            {state.carName} / {state.carBrand}
                                        </td>
                                        <td class="px-6 py-4">
                                            {state.file.name}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div className=" grid grid-cols-2 w-full h-[20vh]">
                        <button onClick={lastCount}>last</button>
                        <button className="bg-green-500 " onClick={submitItem}>Küldés</button>
                    </div>

                </div>
            </div>
        </>
    )

} 
