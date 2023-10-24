import React, { useEffect, useState } from 'react';
import NavBar from '../Navbar/Navbar';
import Footer from '../Footer/Footer';
import "./createPost.css"
import { Container, Row, Col, Form, ListGroup } from 'react-bootstrap';

function CreatePost() {
   const [image, setImage] = useState([]);
   const [link, setLink] = useState([]);

   const handleSubmitForm =(e)=>{
      e.preventDefault();
      console.log(e);
   }

   return (
      <div className="main">
         <NavBar />

         <Container className='conteiner-main center-display'>
            <Form className='form'>
               <Row className='center-display'>
                  <Col className='col-7 '>
                     <Form.Group>
                        <Form.Label>Add Title to Your Blog</Form.Label>
                        <Form.Control type='text'></Form.Control>
                     </Form.Group>
                  </Col>
                  <Col className='col-6'>
                     <Form.Group>
                        <Form.Label>Enter Your Brand</Form.Label>
                        <Form.Control type='text'></Form.Control>
                     </Form.Group>
                  </Col>
                  <Col className='col-6'>
                     <Form.Group>
                        <Form.Label>Add Enter Yout Type of Brand</Form.Label>
                        <Form.Control type='text'></Form.Control>
                     </Form.Group>
                  </Col>
                  <Col className='col-6'>
                     <Form.Group>
                        <Form.Label>Add File to Your Blog</Form.Label>
                        <Form.Control type='file'></Form.Control>
                        <ListGroup className='listGroupClass'>
                           <ListGroup.Item><h1>File(s)</h1></ListGroup.Item>
                           {image.length >= 1 && image.map((item) => {
                              return (<ListGroup.Item className='bg-red center-display'>{item.name}</ListGroup.Item>)
                           })}
                        </ListGroup>
                     </Form.Group>
                  </Col>
                  <Col className='col-6'>
                     <Form.Group>
                        <Form.Label>Add Link To Your Blog</Form.Label>
                        <Form.Control type='text'></Form.Control>
                        <ListGroup className='listGroupClass'>
                           <ListGroup.Item><h1>Link(s)</h1></ListGroup.Item>
                           {link.length >= 1 && link.map((item) => {
                              return (<ListGroup.Item className='bg-red center-display'>{item.name}</ListGroup.Item>)
                           })}
                        </ListGroup>
                     </Form.Group>
                  </Col>

               </Row>
               <hr />
               <Row className='Write center-display'>
                  <Col className='col-12'>
                  <Form.Group>
                     <Form.Label>Write Your Own Blog</Form.Label>
                     <Form.Control type='text' className='write-control' />
                  </Form.Group>
                  </Col>
                  <Col className='col-6'>
                  <Form.Group>
                     <Form.Label>Thank you for your work!</Form.Label>
                     <Form.Control type='submit' onClick={(e)=>{handleSubmitForm(e)}} />
                  </Form.Group>
                  </Col>
               </Row>

            </Form>
         </Container>

         <Footer fixed={"noFix"} />

      </div>

   );
};

export default CreatePost;
