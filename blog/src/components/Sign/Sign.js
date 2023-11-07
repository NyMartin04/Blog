import React, { useState } from 'react';
import NavBar from '../Navbar/Navbar';
import "./Sign.css"
import { Container, Row, Col, Form } from "react-bootstrap";
import Footer from '../Footer/Footer';
import axios from "axios";
function Signup(params) {


  const handlerSubmit = (e)=>{
   e.preventDefault();
if (e.target.pass.value === e.target.repass.value) {
   const data = {
      email: e.target.email.value,
      username:e.target.username.value,
      pass: e.target.pass.value 
   }

   console.log(data);
   // axios.post("",{}).then(res=>{

   // }).catch(err=>{

   // })
}
else{
   alert("Nem jo nem egyeznek az adatok a Jelszonál")
}
  }

   return (
      <Container>
         <h1>Signup</h1>
         <hr/>
         
            <Form onSubmit={handlerSubmit}>
               <Row className='display-auto-center'>
               <Col className='col-12'>
                  <Form.Group>
                     <Form.Label>Enter your Email address</Form.Label>
                     <Form.Control type='text' placeholder='Email' id="email" name="email" />
                  </Form.Group>
               </Col>
               <Col className='col-12'>
                  <Form.Group>
                     <Form.Label>Enter your Username </Form.Label>
                     <Form.Control type='text' placeholder='Username' id="username" name="username" />
                  </Form.Group>
               </Col>
               <Col className='col-6'>
                  <Form.Group>
                     <Form.Label>Enter your password</Form.Label>
                     <Form.Control type='password' placeholder='Password' id="pass" name="pass" />
                  </Form.Group>
               </Col>
               <Col className='col-6'>
                  <Form.Group>
                     <Form.Label>Enter your Re Password</Form.Label>
                     <Form.Control type='password' placeholder='RePassword' id="repass" name="repass" />
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
