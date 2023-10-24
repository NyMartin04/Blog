import React, { useEffect, useState } from 'react';
import "./FAQ.css";
import car3 from "../../images/car3.jpg"
import { Row, Col,Card, CardHeader } from "react-bootstrap"


function Question(params) {

   return (
      <div className='d-flex overFlowFAQ'>

         {params.question.map((item,index)=>{
            return( <Card className='question' style={{maxHeight:"100vh" , maxWidth:"100vh"}}>
            <Card.Header className='cardHeader'  >
               <h1>{item.question}</h1>
            </Card.Header>
         </Card>)
         })}
        
      </div>
   )

}


function Faq(params) {

   const [question, setQuestion] = useState([]);

   useEffect(() => {
      setQuestion([{ question: "Ez egy kérdés",id:0 }, { question: "What Do I Do If..." }, { question: "What Do I Do If..." }, { question: "What Do I Do If..." }, { question: "What Do I Do If..." }, { question: "What Do I Do If..." }])
   }, [])
   return (<div className='Faq'>
      <img className='FAQIMG' src={car3} />
      <div className='relativeBox'>
         <Row className='maxWidth'>
            <Col sm="12" className='title'>
               FAQ
            </Col>
            <Col sm="12" className='questions'>
               <div className='question_Box'>
                  <Question question ={question} />


               </div>
            </Col>
         </Row>
      </div>

   </div>)
}
export default Faq;
