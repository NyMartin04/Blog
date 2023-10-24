import React,{useState} from 'react';
import "./Navbar.css";
import Logo from "../../images/logo.png";
import Acount from "../../images/acount.png"
import Bell from "../../images/bell.png"
import Logout from "../../images/logout.png"
import Heart from "../../images/heart.png"
import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import {Offcanvas,Button } from "react-bootstrap";
function NavTop() {
   return (
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


   const NavItemHref = [
      { href: "/", title: "Home" },{ href: "/sign", title: "Sign" },{ href: "/createpost", title: "CreatePost" }
   ]


   return (<Nav className="me-auto">
  
         {
            NavItemHref.map((item) => {
               return (
       
                     <Nav.Link href={item.href} className='linkNav'>{item.title}</Nav.Link>
                 
               )
            })
         }


   </Nav>)
}

export default function NavBar() {
   const [show, setShow] = useState(false);

   const handleClose = () => setShow(false);
   const handleShow = () => setShow(true);
 
   return (
      <div className="row">
         <div className='col-12 nav-top-side' style={{ display: 'flex', justifyContent: 'right', alignItems: 'center' }}>
            <NavTop />
         </div>
         <div className='col-12  nav-bottom-side'>
            <Navbar bg="light" expand="md">
               <Container>
                  <Navbar.Brand href="/home"><img src={Logo} className='logo' /></Navbar.Brand>
                  <Navbar.Toggle aria-controls="basic-navbar-nav" />
                  <Navbar.Collapse id="basic-navbar-nav">


                     <NavLink />
                     <Button variant="primary" onClick={handleShow}>
        Launch
      </Button>

      <Offcanvas show={show} onHide={handleClose} id='table-container'>
        <Offcanvas.Header closeButton>
          <Offcanvas.Title>Offcanvas</Offcanvas.Title>
        </Offcanvas.Header>
        <Offcanvas.Body>
          Some text as placeholder. In real life you can have the elements you
          have chosen. Like, text, images, lists, etc.
        </Offcanvas.Body>
      </Offcanvas>

                  </Navbar.Collapse>
               </Container>
            </Navbar>

         </div>
      </div>)
}

