<?php
namespace config;

require_once __DIR__ . '\..\..\Autoloader.php';
require_once(__DIR__.'\..\..\vendor\autoload.php');
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPEX;
use config\Exception;
use config\HttpStatus;

class SimplePHPMailer{
    private $mail =null;// new PHPMailer\PHPMailer\PHPMailer();

    public function __construct(){
        try {
            $this->mail->SMTPDebug = 2;                                       
            $this->mail->isSMTP();                                            
            $this->mail->Host       = 'smtp.gfg.com;';                    
            $this->mail->SMTPAuth   = true;                             
            $this->mail->Username   = 'user@gfg.com';                 
            $this->mail->Password   = 'password';                        
            $this->mail->SMTPSecure = 'tls';                              
            $this->mail->Port       = 587;  
         
            $this->mail->setFrom('from@gfg.com', 'Name');           
            $this->mail->addAddress('martinkovacs22@gmail.com');
              
            $this->mail->isHTML(true);                                  
            $this->mail->Subject = 'Subject';
            $this->mail->Body    = 'HTML message body in <b>bold</b> ';
            $this->mail->AltBody = 'Body in plain text for non-HTML mail clients';
            $this->mail->send();
            //echo "Mail has been sent successfully!";
        } catch (PHPEX $e) {
           
            Exception::msg(array("err"=>true,"data"=>$e->getMessage()),HttpStatus::FORBIDDEN);

        }
    }
}
