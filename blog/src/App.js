import React from "react";
import { BrowserRouter as Router,Routes, Route } from 'react-router-dom';
import Home from "./components/Home/Home.js";
import NoPage from "./components/NoPage/NoPage.js";
import 'bootstrap/dist/css/bootstrap.css';

import "./App.css"
function App() {
  return (
    <Router>
    
    <Routes>
            <Route exact path='/' element={< Home />}></Route>
            <Route path='*' element={< NoPage />}></Route>
    </Routes>
    
</Router>
  );
}

export default App;
