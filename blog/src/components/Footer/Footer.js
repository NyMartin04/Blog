import React, { useEffect, useState } from 'react';
import "./Footer.css"
import { Col,Row,ListGroup  } from 'react-bootstrap';
function Footer(proms){
   useEffect(()=>{
      
   },[])

   return(<Row className={proms.fixed}>
      <Col md="6">
      
      </Col>

      <Col md="3">
      
      </Col>

      <Col md="3" style={{ display: 'flex', justifyContent: 'center', alignItems: 'center'}}>
      <ListGroup style={{color:"black", width:"80%",backgroundColor:"none"}}>
      <ListGroup.Item className='listItem bgR'><a target="_blank"  href="https://icons8.com/icon/11727/account">Account</a> icon by <a target="_blank"  href="https://icons8.com">Icons8</a></ListGroup.Item>
      <ListGroup.Item className='listItem bgw'><a target="_blank"  href="https://icons8.com/icon/2445/logout">Logout</a> icon by <a target="_blank"  href="https://icons8.com">Icons8</a></ListGroup.Item>
      <ListGroup.Item className='listItem bgR'><a target="_blank"  href="https://icons8.com/icon/11727/account">Account</a> icon by <a target="_blank"  href="https://icons8.com">Icons8</a></ListGroup.Item>
      <ListGroup.Item className='listItem bgw'><a target="_blank"  href="https://icons8.com/icon/11727/account">Account</a> icon by <a target="_blank"  href="https://icons8.com">Icons8</a></ListGroup.Item>

    </ListGroup>
      </Col>
   </Row>)
}
export default Footer;
