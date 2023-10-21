import React ,{useState}from 'react';
import "./Bloggers.css"
import { Col, Row, Card,Button } from "react-bootstrap";


function CardBlock(proms){

   return(<Row>
      {!(proms.blogger === null || proms.blogger === undefined ) ?proms.blogger.map((item)=>{



         return(<Col md="4" style={{ display: 'flex', justifyContent: 'center', alignItems: 'center' }}>
                    
         <Card className='card-side'>
 <Card.Header className='card-header' >{item.name}</Card.Header>
 <Card.Body style={{height:"auto"}}>
    <Col className='blogger-Script' md="12">
    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
    </Col>
    <Col md="12">
    <Button href='/' className='bottom-card' >Check It</Button>
    </Col>
 </Card.Body>
 
</Card>
         
     </Col>)

      }):proms.exit()}
   </Row>)

}


function Bloggers() {
   const handlerDisplay = ()=>{
      console.log("exit");

     document.getElementById("bloggers")? document.getElementById("bloggers").classList.contains("d-none")?document.getElementById("bloggers").classList.remove("d-none"):document.getElementById("bloggers").classList.add("d-none"):console.log("nincs ilyen");
   }
//bloggers
   return (
      <Row id="bloggers" className='bloggers'>
    <Col style={{ maxHeight: "20vh" }} className='text-white' sm="12"><h1>Bloggers</h1></Col>
    <Col sm="12" className='main-card-Blogger'>
        
    <CardBlock blogger={[{name:"Martin"},{name:"Szabina"},{name:"Elemér"}]} exit={handlerDisplay} />
    </Col>
</Row>

      
   )
}


export default Bloggers;
