import React from 'react';
import "./Navbar.css";
import Logo from "../../images/logo.png";
import Acount from "../../images/acount.png"
import Bell from "../../images/bell.png"
import Logout from "../../images/logout.png"
import Heart from "../../images/heart.png"
import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar  from 'react-bootstrap/Navbar';
import {Row ,Col} from "react-bootstrap";
function NavTop() {
   return(
      <div className='text-white top-nav'>
         <div>
         <img src={Logout} className='icon' />
         </div>
         <div>
         <img src={Heart} className='icon' />
         </div>
            
         <div>
         <img src={Bell} className='icon' />
         </div>
         <div>
         <img src={Acount} className='icon' />
         </div>
            
        
      </div>)

}

function NavLink() {
   return(<Nav className="me-auto">
      <Row>
         <Col md="6">
         <Nav.Link href="/" className='linkNav'>Home</Nav.Link>
         </Col>
         <Col md="6">
         <Nav.Link href="/" className='linkNav'>Home</Nav.Link>
         </Col>
      </Row>
            
 
            
 


</Nav>)
}

export default function NavBar() {
   return (
      <div className="row">
         <div className='col-12 nav-top-side' style={{ display: 'flex', justifyContent: 'right', alignItems: 'center' }}>
            <NavTop/>
         </div>
         <div className='col-12  nav-bottom-side'>
         <Navbar bg="light" expand="md">
      <Container>
        <Navbar.Brand href="/home"><img src={Logo} className='logo' /></Navbar.Brand>
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse  id="basic-navbar-nav">
      

            <NavLink />

       
        </Navbar.Collapse>
      </Container>
    </Navbar>

         </div>
      </div>)
}

