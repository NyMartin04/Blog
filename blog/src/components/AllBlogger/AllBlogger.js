import React, { useEffect, useState } from 'react';
import { Row, Col } from "react-bootstrap";
import "./AllBlogger.css"


function Blogs(params) {
   const content = params.content;
  
   return(
      <div  style={{backgroundColor:"white",display: 'flex', justifyContent: 'center', alignItems: 'center',height:"100%"}} >
         <Row className='overFlowRow' style={{ display: 'flex', justifyContent: 'center', alignItems: 'center',width:"100%",height:"100%" }}>
            {content.map((item,index)=>{
            console.log(item);
          return ( <Col sm="8" style={{ display: 'flex', justifyContent: 'center', alignItems: 'center',width:"70%",height:"auto",minHeight:"20vh",backgroundColor:"red",marginTop:"20px",borderRadius:"20px" }} >
               <Row>
                  <Col sm="12">
                     <Row  style={{ display: 'flex', justifyContent: 'center', alignItems: 'center'}} >
                        <Col md="2"><img  width={"50px"} height={"50px"} style={{ backgroundColor: "white", borderRadius: "20px" }} src={"https://www.tutorialspoint.com/assets/questions/media/426142-1668760872.png"} /></Col>
                        <Col  md="10"><h1 style={{color:"white"}}>{item.title}</h1></Col>
                     </Row>
                  </Col>
                  <hr/>
                  <Col  style={{ display: 'flex', justifyContent: 'center', alignItems: 'center',color:"white",marginBottom:"10px",marginTop:"10px"}} sm="12">
                     {item.script}
                  </Col>
               </Row>
            </Col>)
         })}
         </Row>
         
      </div>
      
   )

}


function AllBlogger() {
   const [allBlogger, setAllBlogger] = useState([]);
   const [allBloggerContent, setAllBloggerContent] = useState([]);
   useEffect(() => {
     
      setAllBlogger([
         { name: "Dominik", PPFile: "https://www.tutorialspoint.com/assets/questions/media/426142-1668760872.png", id: '1', blogs: [{ title: "Hello ka ", id: "1" ,script:"Lényeg telen még" },{ title: "ez egy post ", id: "1" ,script:"Lényeg telen még" },{ title: "Hello ka ", id: "1" ,script:"Lényeg telen még" },{ title: "Hello ka ", id: "1" ,script:"Lényeg telen még" },{ title: "Hello ka ", id: "1" ,script:"Lényeg telen még" },{ title: "Hello ka ", id: "1" ,script:"Lényeg telen még" },{ title: "Hello ka ", id: "1" ,script:"Lényeg telen még" },{ title: "Hello ka ", id: "1" ,script:"Lényeg telen még" },{ title: "Hello ka ", id: "1" ,script:"Lényeg telen még" },{ title: "Hello ka ", id: "1" ,script:"Lényeg telen még" },{ title: "Hello ka ", id: "1" ,script:"Lényeg telen még" },{ title: "Hello ka ", id: "1" ,script:"Lényeg telen még" },{ title: "Hello ka ", id: "1" ,script:"Lényeg telen még" },{ title: "Hello ka ", id: "1" ,script:"Lényeg telen még" },{ title: "Hello ka ", id: "1" ,script:"Lényeg telen még" },{ title: "Hello ka ", id: "1" ,script:"Lényeg telen még" }] },
         { name: "Lajos", PPFile: "https://www.tutorialspoint.com/assets/questions/media/426142-1668760872.png", id: '1', blogs: [{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" },{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" }] },
         { name: "Lajos", PPFile: "https://www.tutorialspoint.com/assets/questions/media/426142-1668760872.png", id: '1', blogs: [{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" }] },
         { name: "Lajos", PPFile: "https://www.tutorialspoint.com/assets/questions/media/426142-1668760872.png", id: '1', blogs: [{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" }] },
         { name: "Lajos", PPFile: "https://www.tutorialspoint.com/assets/questions/media/426142-1668760872.png", id: '1', blogs: [{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" }] },
         { name: "Lajos", PPFile: "https://www.tutorialspoint.com/assets/questions/media/426142-1668760872.png", id: '1', blogs: [{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" }] },
         { name: "Lajos", PPFile: "https://www.tutorialspoint.com/assets/questions/media/426142-1668760872.png", id: '1', blogs: [{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" }] },
         { name: "Lajos", PPFile: "https://www.tutorialspoint.com/assets/questions/media/426142-1668760872.png", id: '1', blogs: [{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" }] },
         { name: "Lajos", PPFile: "https://www.tutorialspoint.com/assets/questions/media/426142-1668760872.png", id: '1', blogs: [{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" }] },
         { name: "Lajos", PPFile: "https://www.tutorialspoint.com/assets/questions/media/426142-1668760872.png", id: '1', blogs: [{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" }] },
         { name: "Lajos", PPFile: "https://www.tutorialspoint.com/assets/questions/media/426142-1668760872.png", id: '1', blogs: [{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" }] },
         { name: "Lajos", PPFile: "https://www.tutorialspoint.com/assets/questions/media/426142-1668760872.png", id: '1', blogs: [{ title: "Meduzák Szporodása", id: "1" ,script:"Lényeg telen még" }] },
      ])
   }, [])
   
   useEffect(()=>{

      if (allBlogger.length >= 1) {
         setAllBloggerContent(allBlogger[0].blogs)
      }
   },[allBlogger])
   return (
      <Row className='AllBlogger'>
         <Col className='leftSide' sm="12" md="4">
            <Row className='overFlow'>
               
               {allBlogger.map((item, index) => {
                  
                  return <Col className='itemAllBlogger' style={{ display: 'flex', justifyContent: 'center', alignItems: 'center' }} sm="12" onClick={() => setAllBloggerContent(item.blogs)}>
                    <Row>
                     <Col md="4" className='imgBlogger' style={{ display: 'flex', justifyContent: 'center', alignItems: 'center' }}>
                     <img src={item.PPFile} width={"50px"} height={"50px"} style={{ backgroundColor: "white", borderRadius: "20px" }} />
                     </Col>
                     <Col md="8" style={{ display: 'flex', justifyContent: 'center', alignItems: 'center' }}>
                     {item.name}
                     </Col>
                     
                    </Row>
                  </Col>
               })}

            </Row>
         </Col>
         <Col className='rightSide' style={{ display: 'flex', justifyContent: 'center', alignItems: 'center'}}  sm="12" md="8">
            <div className='rightSideDiv'>
                        {allBloggerContent.length >= 1 ? <Blogs content={allBloggerContent}/>  : () => { console.log("nincs eleme"); return <div> Nincs Item</div> }}
   
            </div>
         </Col>
      </Row>
   )
}

export default AllBlogger;
