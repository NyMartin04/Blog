import React from "react";
import { BrowserRouter as Router,Routes, Route } from 'react-router-dom';
import Home from "./components/Home/Home.js";
import NoPage from "./components/NoPage/NoPage.js";
import "./App.css"
function App() {
  return (
    <Router>
    <div className="bg-dark" style={{minHeight:"100vh"}}>
    <Routes>
            <Route exact path='/' element={< Home />}></Route>
            <Route path='*' element={< NoPage />}></Route>
    </Routes>
    </div>
</Router>
  );
}

export default App;
