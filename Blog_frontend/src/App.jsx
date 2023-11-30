import { useState } from 'react'
import { BrowserRouter as Router,Routes, Route } from 'react-router-dom';
import Home from "./component/Home/Home.jsx";
import Sign from "./component/Sign/sign.jsx";
// import Sign from "./component/";

function App() {
  return (
    <Router>
    
    <Routes>
            <Route exact path='/' element={<Home />}></Route>
            <Route exact path='/sign' element={<Sign />}></Route>
    </Routes>
    
</Router>

  )
}

export default App
