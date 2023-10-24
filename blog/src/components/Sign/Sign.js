import React, { useState } from 'react';
import NavBar from '../Navbar/Navbar';
import "./Sign.css"
import { Container, Row, Col, Form } from "react-bootstrap";
import Footer from '../Footer/Footer';

function Signup(params) {
   return (
      <Container>
         <h1>Signup</h1>
         <hr/>
         
            <Form>
               <Row className='display-auto-center'>
               <Col className='col-12'>
                  <Form.Group>
                     <Form.Label>Enter your Email address</Form.Label>
                     <Form.Control type='text' placeholder='Email' />
                  </Form.Group>
               </Col>
               <Col className='col-12'>
                  <Form.Group>
                     <Form.Label>Enter your Username </Form.Label>
                     <Form.Control type='text' placeholder='Username' />
                  </Form.Group>
               </Col>
               <Col className='col-6'>
                  <Form.Group>
                     <Form.Label>Enter your password</Form.Label>
                     <Form.Control type='password' placeholder='Password' />
                  </Form.Group>
               </Col>
               <Col className='col-6'>
                  <Form.Group>
                     <Form.Label>Enter your Re Password</Form.Label>
                     <Form.Control type='password' placeholder='RePassword' />
                  </Form.Group>
               </Col>
               <Col className='col-2'>
                  <Form.Group>
                     <Form.Control type='submit' placeholder='Submit your Data' />
                  </Form.Group>
               </Col>
</Row>
            </Form>
      </Container>
   )
}
function Login(params) {
   return (
      <Container>
         <h1>Login</h1>
         <hr/>
         
            <Form>
               <Row className='display-auto-center'>
               <Col className='col-12'>
                  <Form.Group>
                     <Form.Label>Enter your Email address</Form.Label>
                     <Form.Control type='text' placeholder='Email' />
                  </Form.Group>
               </Col>
               
               <Col className='col-12'>
                  <Form.Group>
                     <Form.Label>Enter your password</Form.Label>
                     <Form.Control type='password' placeholder='Password' />
                  </Form.Group>
               </Col>
               
               <Col className='col-2'>
                  <Form.Group>
                     <Form.Control type='submit' placeholder='Submit your Data' />
                  </Form.Group>
               </Col>
</Row>
            </Form>

         
      </Container>
   )
}


function Sign() {
   const [isLoginCol, setIsLoginCol] = useState(false);

   const toggleColClasses = (e) => {
      const clickedElement = e.currentTarget;
      if (clickedElement.classList.contains('col-2')) {
         setIsLoginCol(prevState => !prevState);
      }
   };

   return (
      <div>
         <NavBar />
         <Container className='main-box '>
            <Row>
               <Col
                  className={`login ${isLoginCol ? 'col-2' : 'col-10'}`}
                  onClick={toggleColClasses}
               >
                  {!isLoginCol ? <Login /> : <div>Login</div>}
               </Col>
               <Col
                  className={`signup ${isLoginCol ? 'col-10' : 'col-2'}`}
                  onClick={toggleColClasses}
               >
                  {isLoginCol ? <Signup /> : <div>Signup</div>}
               </Col>
            </Row>
         </Container>
         <Footer fixed={"fixed"}/>
      </div>
   );
}

export default Sign;
