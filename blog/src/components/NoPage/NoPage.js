import React from 'react';
import Navbar from '../Navbar/Navbar';
import Footer from "../Footer/Footer.js"
import "./NoPage.css"
function NoPage () {
   return(
<div>
   <Navbar></Navbar>
   nincs ilyen Side
   <Footer window={window} />
</div>)
};


export default NoPage;
