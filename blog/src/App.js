import React from "react";
import { BrowserRouter as Router,Routes, Route } from 'react-router-dom';
import Home from "./components/Home/Home.js";
import Sign from "./components/Sign/Sign.js";
import NoPage from "./components/NoPage/NoPage.js";
import CreatePost from "./components/createPost/createPost.js";
import 'bootstrap/dist/css/bootstrap.css';

import "./App.css"
function App() {
  return (
    <Router>
    
    <Routes>
            <Route exact path='/' element={< Home />}></Route>
            <Route exact path='/sign' element={< Sign />}></Route>
            <Route exact path='/createpost' element={< CreatePost width={window.getComputedStyle(document.body).getPropertyValue("width").split("px")[0]} height={window.getComputedStyle(document.body).getPropertyValue("height").split("px")[0]} />}></Route>
            <Route path='*' element={< NoPage />}></Route>
    </Routes>
    
</Router>
  );
}

export default App;
