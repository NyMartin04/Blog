import { useState } from 'react'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Home from "./component/Home/Home.jsx";
import Sign from "./component/Sign/sign.jsx";
import Post from "./component/Post/Post.jsx";
import User from './component/UserSide/User.jsx';
import PostGet from './component/Post/PostGet.jsx';
import Profile from './component/UserSide/Porfile.jsx';
// import Sign from "./component/";0

function App() {
  return (
    <Router>

      <Routes>
        <Route exact path='/' element={<Home />}></Route>
        <Route exact path='/sign' element={<Sign />}></Route>
        <Route exact path='/post' element={<Post />}></Route>
        <Route exact path='/user' element={<User />}></Route>
        <Route exact path='/profile' element={<Profile />}></Route>
        <Route exact path='/post/get' element={<PostGet  />}></Route>
      </Routes>

    </Router>

  )
}

export default App
