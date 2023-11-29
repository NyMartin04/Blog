import React,{useEffect,useState} from 'react'

const TopBlogger = () => {
  return (
    <div className='grid grid-cols-1 justify-center bg-red w-full min-h-[40vh]'>
        <div className='text-center my-5 '><h1 className='text-center text-7xl font-bold text-white '>Top Blogger</h1></div>
        
        <div className=' grid grid-cols-1 md:grid-cols-3 justify-center items-center'>
            {/* itt lesz map fg ami a top bloggerek lesznek */}
            <div className='grid justify-center items-center mb-5'>
                <div className='grid grid-cols-1 max-h-[50vh] min-h-[20vh] w-screen md:w-[25vw]  rounded-lg bg-white'>
                <div className='text-center bg-gray rounded-lg justify-center items-center grid shadow-2xl min-h-[15vh]'><h1 className='text-center text-5xl px-10 font-bold text-white'>Kovács Martin </h1></div>
                <div className='grid justify-center items-center text-center text-black font-bold text-xl min-h-[20vh]'>Szöveg a Blogger hez</div>
                <div className='grid justify-center items-center'>
                <button className='rounded-lg bg-red  hover:bg-red-400 py-4 px-16 mb-5'><a className='shadow-2xl text-white'>Home</a></button>
                </div>
                </div>
            </div>
            <div className='grid justify-center items-center mb-5'>
                <div className='grid grid-cols-1 max-h-[50vh] min-h-[20vh] w-screen md:w-[25vw]  rounded-lg bg-white'>
                <div className='text-center bg-gray rounded-lg justify-center items-center grid shadow-2xl min-h-[15vh]'><h1 className='text-center text-5xl px-10 font-bold text-white'>Kovács  </h1></div>
                <div className='grid justify-center items-center text-center text-black font-bold text-xl min-h-[20vh]'>Szöveg a Blogger hez</div>
                <div className='grid justify-center items-center'>
                <button className='rounded-lg bg-red  hover:bg-red-400 py-4 px-16 mb-5'><a className='shadow-2xl text-white'>Home</a></button>
                </div>
                </div>
            </div>
            <div className='grid justify-center items-center mb-5'>
                <div className='grid grid-cols-1 max-h-[50vh] min-h-[20vh] w-screen md:w-[25vw]  rounded-lg bg-white'>
                <div className='text-center bg-gray rounded-lg justify-center items-center grid shadow-2xl min-h-[15vh]'><h1 className='text-center text-5xl px-10 font-bold text-white'>Kovács Martin </h1></div>
                <div className='grid justify-center items-center text-center text-black font-bold text-xl min-h-[20vh]'>Szöveg a Blogger hez</div>
                <div className='grid justify-center items-center'>
                <button className='rounded-lg bg-red  hover:bg-red-400 py-4 px-16 mb-5'><a className='shadow-2xl text-white'>Home</a></button>
                </div>
                </div>
            </div>

        </div>
    </div>
  )
}

export default TopBlogger